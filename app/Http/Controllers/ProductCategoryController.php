<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Services\DataTableService;
use App\Services\SlugService;
use App\Services\JsonResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            ->editColumn('image', function ($q) {
                if ($q->image !== null) {
                    return Storage::url('product-category/' . $q->image);
                }

                return asset('assets/media/images/no-image.png');
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

        $imageName = null;
        if (session()->has('temp_product_category_image')) {
            $imageName = session('temp_product_category_image');

            // Pindahkan dari folder temp ke folder tujuan menggunakan Storage
            if (Storage::disk('public')->exists('temp/' . $imageName)) {
                // Baca konten file
                $fileContent = Storage::disk('public')->get('temp/' . $imageName);

                // Simpan ke lokasi baru
                Storage::disk('public')->put('product-category/' . $imageName, $fileContent);

                // Hapus file temporary
                Storage::disk('public')->delete('temp/' . $imageName);
            }

            // Hapus dari session
            session()->forget('temp_product_category_image');
        }

        DB::beginTransaction();
        try {
            ProductCategory::create([
                'slug' => $this->slugService->createUniqueSlug($request->name, ProductCategory::class),
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
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

    public function uploadImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Simpan file sementara menggunakan Storage
            $path = Storage::disk('public')->putFileAs(
                'temp',
                $image,
                $imageName
            );

            // Simpan nama file di session
            session(['temp_product_category_image' => $imageName]);

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil diunggah',
                'filename' => $imageName
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
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

        // Cek apakah ada gambar baru yang diupload
        $imageName = $productCategory->image; // Default: gambar yang sudah ada

        if (session()->has('temp_product_category_image')) {
            // Hapus gambar lama jika ada
            if ($productCategory->image && Storage::disk('public')->exists('product-category/' . $productCategory->image)) {
                Storage::disk('public')->delete('product-category/' . $productCategory->image);
            }

            // Gunakan gambar baru
            $imageName = session('temp_product_category_image');

            // Pindahkan dari folder temp ke folder tujuan
            if (Storage::disk('public')->exists('temp/' . $imageName)) {
                // Baca konten file
                $fileContent = Storage::disk('public')->get('temp/' . $imageName);

                // Simpan ke lokasi baru
                Storage::disk('public')->put('product-category/' . $imageName, $fileContent);

                // Hapus file temporary
                Storage::disk('public')->delete('temp/' . $imageName);
            }

            // Hapus dari session
            session()->forget('temp_product_category_image');
        }

        DB::beginTransaction();
        try {
            $productCategory->update([
                'slug' => $this->slugService->createUniqueSlug($request->name, ProductCategory::class),
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imageName,
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
            // Hapus gambar jika ada
            if ($productCategory->image && Storage::disk('public')->exists('product-category/' . $productCategory->image)) {
                Storage::disk('public')->delete('product-category/' . $productCategory->image);
            }

            $productCategory->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponseService->error($e->getMessage());
        }

        DB::commit();
        return $this->jsonResponseService->success('Berhasil menghapus kategori produk');
    }
}
