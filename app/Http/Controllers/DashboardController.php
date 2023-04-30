<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Analysis;

class DashboardController extends Controller
{
    public function index()
    {
        $data_analisis = Analysis::where('user_id', auth()->user()->id)->get();
        return view('dashboard.index', [
            'title' => 'Dashboard',
            'monitors' => Monitor::where('user_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
            // 'pendapatan' => Analysis::where('user_id', auth()->user()->id),
            // 'produk'=>,
            // 'pemesanan'=>,
            // 'forum'=>,
        ]);
    }
}
