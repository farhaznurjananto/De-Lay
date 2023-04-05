<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.index', [
            'title' => 'Profile',
            'user' => User::where('id', auth()->user()->id)->get(),
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns',
            'phone' => 'required|numeric',
        ]);


        if ($request->name != auth()->user()->name) {
            User::where('id', auth()->user()->id)
                ->update(['name' => $validatedData['name']]);
        }

        if ($request->email != auth()->user()->email) {
            User::where('id', auth()->user()->id)
                ->update(['email' => $validatedData['email']]);
        }

        if ($request->phone != auth()->user()->phone) {
            User::where('id', auth()->user()->id)
                ->update(['phone' => $validatedData['phone']]);
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
