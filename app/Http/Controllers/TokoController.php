<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokoController extends Controller
{
    public function index()
    {
        return view('dashboard.market', [
            'title' => 'Market',
            'products' => Product::where('status', 1)->latest()->paginate(10)->withQueryString(),
        ]);
    }

    public function show(Product $product)
    {
        // return $product->owner_id;
        return view('dashboard.order.create', [
            'title' => 'Order',
            'product' => $product,
            // 'user' => User::where('id', $product->owner_id)->get(),
        ]);
    }
}
