<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Home Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class HomeController dengan berbagai method 
| yang menghubungkan antara View dengan Model.
|
*/

class HomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view landing page
    |
    */

    public function index()
    {
        return view('landing-page', [
            'data' => User::where('is_admin', '=', 1)->get(),
        ]);
    }
}
