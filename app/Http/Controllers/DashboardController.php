<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_petani()
    {
        return view('dashboard-petani.index', [
            'title' => 'Dashboard Petani',
        ]);
    }

    public function index_produsen()
    {
        return view('dashboard-produsen.index', [
            'title' => 'Dashboard Produsen',
        ]);
    }
}
