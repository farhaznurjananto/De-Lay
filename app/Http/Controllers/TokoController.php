<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokoController extends Controller
{
    public function index()
    {
        return view('dashboard.market', [
            'title' => 'Market',
            'products' => Product::all()
        ]);
    }

    public function show(Product $product)
    {
        return view('dashboard.order.create', [
            'title' => 'Order',
            'product' => $product,
        ]);
    }
}
