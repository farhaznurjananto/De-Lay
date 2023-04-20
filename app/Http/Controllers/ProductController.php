<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // FARMER

    public function index()
    {
        return view('dashboard.product.index', [
            'title' => 'Produk',
            'products' => Product::where('owner_id', auth()->user()->id)->latest()->paginate(6)->withQueryString(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'image' => 'image|file|max:1024',
                'name' => 'required|max:255',
                'stock' => 'required|numeric|min:1',
                'price' => 'required|numeric|min:1',
                'rekening' => 'numeric',
                'address' => 'max:255'
            ];

            $validateData = request()->validate($rules);

            $validateData['owner_id'] = auth()->user()->id;
            if ($request->file('image')) {
                $validateData['image'] = $request->file('image')->store('product-images');
            }

            Product::create($validateData);

            return back()->with('success', 'Pruduk baru berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Pruduk gagal ditambahkan!') && $validateData = request()->validate($rules);
        }
    }

    public function edit(Product $product)
    {
        return view('dashboard.product.edit', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $rules = [
            'image' => 'image|file|max:1024',
            'name' => 'required|max:255',
            'stock' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'rekening' => 'numeric',
            'address' => 'max:255',
            'status' => 'required'
        ];

        $validateData = request()->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('product-images');
        }

        $validateData['owner_id'] = auth()->user()->id;
        if ($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('product-images');
        }


        Product::where('id', $product->id)
            ->update($validateData);

        return redirect('/dashboard/product')->with('success', 'Pr0duk berhasil diperbaruhi!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);

        return back()->with('success', 'Produk berhasil dihapus!');
    }

    // PRODUSEN

    public function market()
    {
        return view('dashboard.market.index', [
            'title' => 'Market',
            'products' => Product::where([['status', 1], ['stock', '<>', 0]])->latest()->paginate(10)->withQueryString(),
        ]);
    }
}
