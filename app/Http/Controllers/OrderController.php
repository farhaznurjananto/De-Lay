<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    // ALL
    public function index()
    {
        if (auth()->user()->actor_id == 1) {
            $value = auth()->user()->id;

            $orders = Order::with(['product' => function ($q) use ($value) {
                $q->where('owner_id', '=', $value);
            }])->where('status', '<>', 'accepted')->latest()->paginate(10);
        } elseif (auth()->user()->actor_id == 2) {
            $orders = Order::with('product')->where([['customer_id', '=', auth()->user()->id], ['status', '<>', 'accepted']])->latest()->paginate(10);
        }

        return view('dashboard.order.index', [
            'title' => 'Pemesanan',
            'orders' => $orders
        ]);
    }

    public function history()
    {
        if (auth()->user()->actor_id == 1) {
            $value = auth()->user()->id;

            $orders = Order::with(['product' => function ($q) use ($value) {
                $q->where('owner_id', '=', $value);
            }])->where('status', '=', 'accepted')->latest()->paginate(10);
        } elseif (auth()->user()->actor_id == 2) {
            $orders = Order::with('product')->where([['customer_id', '=', auth()->user()->id], ['status', '=', 'accepted']])->latest()->paginate(10);
        }

        return view('dashboard.order.history', [
            'title' => 'History',
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        return view('dashboard.order.show', [
            'title' => 'Detail Pemesanan',
            'order' => $order->load(['user', 'product']),
        ]);
    }

    // FARMER

    public function update(Request $request, Order $order)
    {
        if (auth()->user()->actor_id == 1) {
            $validatedData = $request->validate([
                'status' => 'required|max:255',
                'feedback' => 'required|max:255'
            ]);

            if ($request->status == 'accepted') {
                $validatedData['acc_date'] = now();
            }

            // return $validatedData;

            Order::where('id', $order->id)
                ->update($validatedData);

            // INI PRODUCTNYA BELUM NAMBAH KALAU DI REJECT

            if ($validatedData['status'] == 'rejected') {
                return redirect('/dashboard/order')->with('success', 'Order berhasil ditolak!');
            } else {
                return redirect('/dashboard/order')->with('success', 'Order berhasil diterima!');
            }
        }
    }

    public function destroy(Order $order)
    {
        $tmp_stock = $order->product->stock + $order['quantity'];

        // DELETE PROOF OF PAYMENT IMG
        if ($order->proof_of_payment) {
            Storage::delete($order->proof_of_payment);
        }

        // UPDATE PRODUCT STOCK
        Product::where('id', $order->product->id)
            ->update(['stock' => $tmp_stock]);

        Order::destroy($order->id);

        return redirect('/dashboard/order')->with('success', 'Pemesanan berhasil dibatalkan!');
    }

    // PRODUSEN

    public function create(Product $product)
    {
        return view('dashboard.order.create', [
            'title' => 'Order',
            'product' => $product,
        ]);
    }

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

        // UPDATE STOCK PRODUCT
        $product = Product::where('id', $request['product_id'])->get();
        $tmp_stock = $product[0]['stock'] - $validatedData['quantity'];

        if ($tmp_stock < 0) {
            return back()->with('error', 'Inputkan data dengan benar!');
        } else {
            if ($request->file('proof_of_payment')) {
                $validatedData['proof_of_payment'] = $request->file('proof_of_payment')->store('proof-of-payment-images');
            }

            Order::create($validatedData);
            Product::where('id', $request->product_id)
                ->update(['stock' => $tmp_stock]);

            return redirect('/dashboard/market')->with('success', 'Pemesanan baru berhasil ditambahkan. Menunggu konfirmasi dari penjual!');
        }
    }

    public function edit(Order $order)
    {
        return view('dashboard.order.edit', [
            'title' => 'Edit Pemesanan',
            'order' => $order
        ]);
    }
}
