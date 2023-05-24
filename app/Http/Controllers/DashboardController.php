<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Http\Controllers\Controller;
use App\Models\Analysis;
use App\Models\Product;
use App\Models\Forum;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| Dashboard Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class DashboardController dengan berbagai method 
| yang menghubungkan antara View dengan Model. 
|
*/

class DashboardController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view dashboard
    |
    */

    public function index()
    {
        // FARMER
        $value = auth()->user()->id;
        $incomes = Analysis::select('total_income')->where('user_id', auth()->user()->id)->get()->sum('total_income');
        $orders = Order::with(['product' => function ($q) use ($value) {
            $q->where('owner_id', '=', $value);
        }])->where('status', '=', 'pending')->count();
        $porducts = Product::where('owner_id', auth()->user()->id)->get()->count();
        $forums = Forum::where('user_id', auth()->user()->id)->get()->count();

        // PRODUSEN
        $orders_produsen = Order::where([['customer_id', '=', auth()->user()->id], ['status', '=', 'pending']])->count();
        $total_orders = Order::where([['customer_id', '=', auth()->user()->id], ['status', '=', 'accepted']])->count();
        $transaction = Analysis::with('user')->where('user_id', '=', auth()->user()->id)->paginate(10);
        $labels = [];
        $provit = [];
        foreach ($transaction as $data) {
            array_push($labels, $data->created_at->format('d M Y'));
            array_push($provit, ($data->total_income - $data->initial_capital));
        }

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'monitors' => Monitor::where('user_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
            'incomes' => $incomes,
            'orders' => $orders,
            'products' => $porducts,
            'forums' => $forums,
            'orders_produsen' => $orders_produsen,
            'total_orders' => $total_orders,
            'labels' => $labels,
            'profit' => $provit
        ]);
    }
}
