<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;

class MarketController extends Controller
{
    public function index()
    {
        return view('dashboard.market', [
            'title' => 'Market',
            'products' => Product::where('status', 1)->latest()->paginate(10)->withQueryString(),
        ]);
    }

    // public function show(Product $product)
    // {
    //     return view('dashboard.order.create', [
    //         'title' => 'Order',
    //         'product' => $product,
    //     ]);
    // }
}
