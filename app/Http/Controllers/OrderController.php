<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.order.index', [
            'title' => 'Pemesanan',
            'orders' => Order::where([['customer_id', '=', auth()->user()->id], ['status', '<>', 'accepted']])->latest()->paginate(10)->withQueryString(),
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
        $rules = [
            'product_id' => 'required',
            'quantity' => 'required|numeric|min:1',
            'proof_of_payment' => 'image|file|max:1024',
            'customer_address' => 'max:255'
        ];

        $validatedData = request()->validate($rules);

        $validatedData['customer_id'] = auth()->user()->id;

        if ($request->file('proof_of_payment')) {
            $validatedData['proof_of_payment'] = $request->file('proof_of_payment')->store('proof-of-payment-images');
        }

        Order::create($validatedData);

        // update stock product
        $product = Product::where('id', $request['product_id'])->get();
        $tmp_stock = $product[0]['stock'] - $validatedData['quantity'];

        Product::where('id', $request->product_id)
            ->update(['stock' => $tmp_stock]);

        return redirect('/dashboard/market')->with('success', 'Pemesanan baru berhasil ditambahkan. Menunggu konfirmasi dari penjual!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return 'show';
        return view('dashboard.order.show', [
            'title' => 'Detail Pemesanan',
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(Order $order)
    {
        $tmp_stock = $order->product->stock + $order['quantity'];

        // delete proof of payment img
        if ($order->proof_of_payment) {
            Storage::delete($order->proof_of_payment);
        }

        // update product
        Product::where('id', $order->product->id)
            ->update(['stock' => $tmp_stock]);

        Order::destroy($order->id);

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
