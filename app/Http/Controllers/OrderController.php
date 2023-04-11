<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->actor_id == 1) {
            $orders = DB::table('orders')
                ->join('products', 'orders.product_id', '=', 'products.id')
                ->join('users', 'products.owner_id', '=', 'users.id')
                ->where([['products.owner_id', '=', auth()->user()->id], ['orders.status', '<>', 'accepted']])
                ->select('orders.*', 'products.name')
                ->latest()->paginate(5);

            return view('dashboard.order.indexPetani', [
                'title' => 'Pemesanan',
                'orders' => $orders,
            ]);
        } elseif (auth()->user()->actor_id == 2) {
            return view('dashboard.order.indexProdusen', [
                'title' => 'Pemesanan',
                'orders' => Order::with('product')->where([['customer_id', '=', auth()->user()->id], ['status', '<>', 'accepted']])->latest()->paginate(10),
            ]);
        }
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
        return view('dashboard.order.show', [
            'title' => 'Detail Pemesanan',
            'order' => $order->load(['user']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('dashboard.order.edit', [
            'title' => 'Edit Pemesanan',
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if (auth()->user()->actor_id == 1) {
            $validatedData = $request->validate([
                'status' => 'required|max:255',
            ]);

            Order::where('id', $order->id)
                ->update($validatedData);

            return redirect('/dashboard/order')->with('success', 'Order berhasil direject!');
        }
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

        return redirect('/dashboard/order')->with('success', 'Produk berhasil dihapus!');
    }
}
