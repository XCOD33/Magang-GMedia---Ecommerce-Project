<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Services\DataTableService;
use App\Services\SlugService;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    private $dataTableService;
    private $slugService;
    private $jsonResponseService;

    public function __construct(DataTableService $dataTableService, SlugService $slugService, JsonResponseService $jsonResponseService)
    {
        $this->dataTableService = $dataTableService;
        $this->slugService = $slugService;
        $this->jsonResponseService = $jsonResponseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.data-master.product-category.index');
    }

    public function dataTable()
    {
        $productCategories = ProductCategory::all();

        return datatables($productCategories)
            ->addIndexColumn()
            ->editColumn('slug', function ($q) {
                return '<a href="' . route('category.index', $q->slug) . '">' . $q->slug . '</a>';
            })
            ->addColumn('total_product', function ($q) {
                return '<span class="badge bg-success text-white">' . $q->products->count() . '</span>';
            })
            ->addColumn('action', function ($q) {
                return $this->dataTableService->generateActionButtons(
                    $q->id,
                    route('dashboard.data-master.product-category.edit', $q->id),
                    route('dashboard.data-master.product-category.delete', $q->id)
                );
            })
            ->rawColumns([
                'slug',
                'total_product',
                'action'
            ])
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dashboard.data-master.product-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.string' => 'Nama kategori harus berupa string',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
            'description.min' => 'Deskripsi minimal 3 karakter',
            'description.max' => 'Deskripsi maksimal 255 karakter',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            ProductCategory::create([
                'slug' => $this->slugService->createUniqueSlug($request->name, ProductCategory::class),
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();
        toastr()->success('Berhasil menambahkan kategori produk baru');

        return redirect()->route('dashboard.data-master.product-category.index');
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
        $productCategory = ProductCategory::findOrFail($id);
        return view('pages.dashboard.data-master.product-category.edit', [
            'productCategory' => $productCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productCategory = ProductCategory::findOrFail($id);

        $validation = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3|max:255',
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.string' => 'Nama kategori harus berupa string',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'name.max' => 'Nama kategori maksimal 255 karakter',
            'description.required' => 'Deskripsi harus diisi',
            'description.string' => 'Deskripsi harus berupa string',
            'description.min' => 'Deskripsi minimal 3 karakter',
            'description.max' => 'Deskripsi maksimal 255 karakter',
        ]);

        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->back()->withInput();
        }

        DB::beginTransaction();
        try {
            $productCategory->update([
                'slug' => $this->slugService->createUniqueSlug($request->name, ProductCategory::class),
                'name' => $request->name,
                'description' => $request->description,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back()->withInput();
        }

        DB::commit();
        toastr()->success('Berhasil mengubah kategori produk');

        return redirect()->route('dashboard.data-master.product-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find($id);
        if (!$productCategory) {
            return $this->jsonResponseService->error('Kategori produk tidak ditemukan');
        }

        DB::beginTransaction();
        try {
            $productCategory->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponseService->error($e->getMessage());
        }

        DB::commit();
        return $this->jsonResponseService->success('Berhasil menghapus kategori produk');
    }
}
