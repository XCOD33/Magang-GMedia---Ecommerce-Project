<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DataTableService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $dataTableService;

    public function __construct(DataTableService $dataTableService)
    {
        $this->dataTableService = $dataTableService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.data-master.user.index');
    }

    public function dataTable()
    {
        $users = User::all();

        return datatables($users)
            ->addIndexColumn()
            ->editColumn('email', function ($q) {
                return $this->dataTableService->maskEmail($q->email);
            })
            ->editColumn('role', function ($q) {
                return $this->dataTableService->generateRoleBadge($q->role);
            })
            ->addColumn('action', function ($q) {
                return $this->dataTableService->generateActionButtons($q->id, route('dashboard.data-master.user.edit', $q->id));
            })
            ->rawColumns(['role', 'action'])
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
        //
    }
}
