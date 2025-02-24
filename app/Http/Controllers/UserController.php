<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DataTableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
                return $this->dataTableService->generateActionButtons(
                    $q->id,
                    route('dashboard.data-master.user.edit', $q->id),
                    route('dashboard.data-master.user.delete', $q->id)
                );
            })
            ->rawColumns(['role', 'action'])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.data-master.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:2550',
            'email' => 'required|min:3|max:255|email|unique:users,email',
            'password' => 'required|min:3|max:255|confirmed',
            'role' => 'required|in:admin,seller,buyer',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.min' => 'Email minimal 3 karakter',
            'email.max' => 'Email maksimal 255 karakter',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 3 karakter',
            'password.max' => 'Password maksimal 255 karakter',
            'password.confirmed' => 'Password tidak sama',
            'role.required' => 'Role tidak boleh kosong',
            'role.in' => 'Role tidak valid',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return back()->withInput();
        }

        DB::beginTransaction();
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Gagal menambahkan user baru');

            return back()->withInput();
        }

        DB::commit();
        toastr()->success('Berhasil menambahkan user baru');
        return redirect()->route('dashboard.data-master.user.index');
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
        $user = User::findOrFail($id);

        return view('pages.dashboard.data-master.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'name' => 'required|min:3|max:2550',
            'email' => 'required|min:3|max:255|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,seller,buyer',
            'password' => 'nullable|min:3|max:255|confirmed',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.min' => 'Email minimal 3 karakter',
            'email.max' => 'Email maksimal 255 karakter',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah digunakan',
            'role.required' => 'Role tidak boleh kosong',
            'role.in' => 'Role tidak valid',
            'password.min' => 'Password minimal 3 karakter',
            'password.max' => 'Password maksimal 255 karakter',
            'password.confirmed' => 'Password tidak sama',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return back()->withInput();
        }

        DB::beginTransaction();
        try {
            $updateData = [
                'name' => $request->name,
                'role' => $request->role,
            ];

            if ($request->email != $user->email) {
                $updateData['email'] = $request->email;
            }

            if ($request->filled('password')) {
                $updateData['password'] = bcrypt($request->password);
            }

            $user->update($updateData);
        } catch (\Throwable $th) {
            DB::rollBack();
            toastr()->error('Gagal mengubah user');

            return back()->withInput();
        }

        DB::commit();
        toastr()->success('Berhasil mengubah user');
        return redirect()->route('dashboard.data-master.user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ]);
        }

        DB::beginTransaction();
        try {
            $user->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menghapus user',
        ]);
    }
}
