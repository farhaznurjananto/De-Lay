<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile',
            'user' => User::where('id', auth()->user()->id)->get(),
        ]);
    }

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
