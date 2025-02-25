<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class ProductService
{
    public function getProducts()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return Product::with([
                'store',
                'productCategory'
            ])->get();
        }

        $store = Store::where('user_id', Auth::id())->first();

        return Product::whereHas('store', function ($q) use ($store) {
            $q->where('id', $store->id);
        })->with([
            'store',
            'productCategory'
        ])->get();
    }
}
