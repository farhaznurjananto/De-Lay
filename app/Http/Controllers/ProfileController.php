<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Profile Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class ProfileController dengan berbagai method 
| yang menghubungkan antara View dengan Model Profile. 
|
*/

class ProfileController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view profile
    |
    */

    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile',
            'user' => User::where('id', auth()->user()->id)->get(),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan update data yang telah di 
    | edit untuk diupdate di database
    |
    */

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns',
            'phone' => 'required|numeric',
        ]);

        if ($request->name != $user->name) {
            User::where('id', $user->id)
                ->update(['name' => $validatedData['name']]);
        }

        if ($request->email != $user->email) {
            User::where('id', $user->id)
                ->update(['email' => $validatedData['email']]);
        }

        if ($request->phone != $user->phone) {
            User::where('id', $user->id)
                ->update(['phone' => $validatedData['phone']]);
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }
}
