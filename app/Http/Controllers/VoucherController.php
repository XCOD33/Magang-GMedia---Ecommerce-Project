<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Services\DataTableService;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VoucherController extends Controller
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
        return view('pages.dashboard.data-master.voucher.index');
    }

    public function dataTable()
    {
        $vouchers = Voucher::all();

        return datatables($vouchers)
            ->addIndexColumn()
            ->editColumn('code', function ($q) {
                return $q->code;
            })
            ->editColumn('discount', function ($q) {
                return 'Rp' . number_format($q->discount, 0, ',', '.');
            })
            ->editColumn('expired_at', function ($q) {
                return Carbon::parse($q->expired_at)->format('d F Y');
            })
            ->addColumn('action', function ($q) {
                return $this->dataTableService->generateActionButtons(
                    $q->id,
                    route('dashboard.data-master.voucher.edit', $q->id),
                    route('dashboard.data-master.voucher.delete', $q->id)
                );
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.data-master.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'discount' => 'required|numeric',
            'expired_at' => 'required|date|after_or_equal:today'
        ], [
            'discount.required' => 'Discount tidak boleh kosong',
            'discount.numeric' => 'Discount harus berupa angka',
            'expired_at.required' => 'Tanggal kadaluarsa tidak boleh kosong',
            'expired_at.date' => 'Tanggal kadaluarsa harus berupa tanggal',
            'expired_at.after_or_equal' => 'Tanggal kadaluarsa harus lebih besar atau sama dengan hari ini',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            Voucher::create([
                'code' => Str::upper(Str::random(6)),
                'discount' => $request->discount,
                'expired_at' => $request->expired_at,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        toastr()->success('Voucher berhasil ditambahkan');
        return redirect()->route('dashboard.data-master.voucher.index');
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
        $voucher = Voucher::findOrFail($id);
        return view('pages.dashboard.data-master.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $voucher = Voucher::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'discount' => 'required|numeric',
            'expired_at' => 'required|date|after_or_equal:today'
        ], [
            'discount.required' => 'Discount tidak boleh kosong',
            'discount.numeric' => 'Discount harus berupa angka',
            'expired_at.required' => 'Tanggal kadaluarsa tidak boleh kosong',
            'expired_at.date' => 'Tanggal kadaluarsa harus berupa tanggal',
            'expired_at.after_or_equal' => 'Tanggal kadaluarsa harus lebih besar atau sama dengan hari ini',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            $voucher->update([
                'discount' => $request->discount,
                'expired_at' => $request->expired_at,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();

        toastr()->success('Voucher berhasil diperbarui');
        return redirect()->route('dashboard.data-master.voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $voucher = Voucher::find($id);
        if (!$voucher) {
            return $this->jsonResponseService->error('Voucher tidak ditemukan');
        }

        DB::beginTransaction();
        try {
            $voucher->delete();
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->jsonResponseService->error($e->getMessage());
        }

        DB::commit();

        return $this->jsonResponseService->success('Voucher berhasil dihapus');
    }
}
