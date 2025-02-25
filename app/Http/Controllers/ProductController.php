<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\DataTableService;
use App\Services\JsonResponseService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $dataTableService;
    private $jsonResponseService;

    public function __construct(ProductService $productService, DataTableService $dataTableService, JsonResponseService $jsonResponseService)
    {
        $this->productService = $productService;
        $this->dataTableService = $dataTableService;
        $this->jsonResponseService = $jsonResponseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard.product.index');
    }

    public function dataTable()
    {
        $products = $this->productService->getProducts();

        return datatables($products)
            ->addIndexColumn()
            ->addColumn('store', function ($q) {
                return $q->store->name;
            })
            ->addColumn('category', function ($q) {
                return $q->productCategory->name;
            })
            ->editColumn('slug', function ($q) {
                return '<a href="' . route('category.index', $q->slug) . '">' . $q->slug . '</a>';
            })
            ->editColumn('price', function ($q) {
                return 'Rp ' . number_format($q->price, 0, ',', '.');
            })
            ->editColumn('stock', function ($q) {
                return number_format($q->stock, 0, ',', '.');
            })
            ->editColumn('status', function ($q) {
                if ($q->status == 'draft') {
                    return '<span class="badge bg-secondary">Draft</span>';
                } else if ($q->status == 'active') {
                    return '<span class="badge bg-success">Active</span>';
                } else if ($q->status == 'inactive') {
                    return '<span class="badge bg-danger">Inactive</span>';
                }
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
        return view('pages.dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \dd($request->all());
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
        $product = Product::findOrFail($id);

        return view('pages.dashboard.product.edit', [
            'product' => $product
        ]);
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

    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/temp', $filename);

            return response()->json([
                'filename' => $filename
            ]);
        }

        return response()->json([
            'error' => 'Tidak ada file yang diupload'
        ], 400);
    }
}
