<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Services\DataTableService;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    private $dataTableService;
    private $jsonResponseService;

    public function __construct(DataTableService $dataTableService, JsonResponseService $jsonResponseService)
    {
        $this->dataTableService = $dataTableService;
        $this->jsonResponseService = $jsonResponseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.data-master.store.index');
    }

    public function dataTable()
    {
        $stores = Store::all();

        return datatables($stores)
            ->addIndexColumn()
            ->addColumn('owner', function ($q) {
                return $q->user->name;
            })
            ->addColumn('total_product', function ($q) {
                return '<span class="badge bg-success">' . $q->products->count() . '</span>';
            })
            ->editColumn('logo_url', function ($q) {
                return '<img src="' . Storage::url($q->logo_url) . '" alt="' . $q->name . '" class="img-fluid rounded-md">';
            })
            ->addColumn('action', function ($q) {
                return $this->dataTableService->generateActionButtons(
                    $q->id,
                    route('dashboard.data-master.store.edit', $q->id),
                    route('dashboard.data-master.store.delete', $q->id)
                );
            })
            ->rawColumns(['logo_url', 'action', 'total_product'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Store::find($id);
        if (!$store) {
            return $this->jsonResponseService->error('Toko tidak ditemukan');
        }

        DB::beginTransaction();
        try {
            $store->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return $this->jsonResponseService->error($e->getMessage());
        }

        DB::commit();
        return $this->jsonResponseService->success('Berhasil menghapus toko');
    }
}
