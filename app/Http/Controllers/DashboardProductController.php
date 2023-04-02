<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.product.index', [
            'title' => 'Produk',
            'products' => Product::where('owner_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
        ]);
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
        try {
            $rules = [
                'image' => 'image|file|max:1024',
                'name' => 'required|max:255',
                'stock' => 'required|numeric|min:1',
                'price' => 'required|numeric|min:1'
            ];

            $validateData = request()->validate($rules);

            $validateData['owner_id'] = auth()->user()->id;
            if ($request->file('image')) {
                $validateData['image'] = $request->file('image')->store('product-images');
            }

            Product::create($validateData);

            return redirect()->back()->with('success', 'Pruduk baru berhasil ditambahkan!');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', 'Pruduk gagal ditambahkan!') && $validateData = request()->validate($rules);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // return $product;
        return view('dashboard.product.edit', [
            'title' => 'Edit Product',
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'image' => 'image|file|max:1024',
            'name' => 'required|max:255',
            'stock' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1'
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

        return redirect('/dashboard/product')->with('success', 'Pruduk baru berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete($product->image);
        }
        Product::destroy($product->id);

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
