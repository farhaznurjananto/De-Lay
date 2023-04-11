<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mendapatkan order sesuai product yang dimiliki oleh owner
        // $orders_all = Order::where('status', '<>', 'accepted')->latest()->paginate(10)->withQueryString();
        // $orders = [];
        // foreach ($orders_all as $order) {
        //     if ($order->product->owner_id == auth()->user()->id) {
        //         array_push($orders, $order);
        //     }
        // }
        // return $orders;
        // return Order::where([['owner_id', '=', auth()->user()->id], ['status', '<>', 'accepted']])->latest()->paginate(10)->withQueryString();
        // return 'transaksi';
        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('users', 'products.owner_id', '=', 'users.id')
            ->where([['products.owner_id', '=', auth()->user()->id], ['orders.status', '=', 'accepted']])
            ->select('orders.*', 'products.name')
            ->latest()->paginate(5);

        return $orders;

        return view('dashboard.transaction.index', [
            'title' => 'Daftar Pemesanan',
            'orders' => $orders
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }
}
