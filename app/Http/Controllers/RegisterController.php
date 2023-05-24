<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Register Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class RegisterController dengan berbagai method 
| yang menghubungkan antara View dengan Model Register. 
|
*/

class RegisterController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view register
    |
    */

    public function index()
    {
        return view('register.index', [
            'title' => 'Register',
            'actors' => Actor::all()
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan data user baru ke database
    |
    */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
            'phone' => 'required|numeric|unique:users',
            'actor_id' => 'required',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silahkan Login.');
    }
}
