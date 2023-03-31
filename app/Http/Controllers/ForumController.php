<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Forum_Category;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Forum::where('user_id', auth()->user()->id)->get();
        return view('dashboard.forum.index', [
            'title' => 'Forum Anda',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::where('user_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
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
        $validateData = $request->validate([
            'question' => 'required|max:255',
            'forum_category_id' => 'required',
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Forum::create($validateData);

        return redirect('/dashboard/forum')->with('success', 'Forum baru berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        return view('dashboard.forum.edit', [
            'title' => 'Edit Forum',
            'forum_categories' => Forum_Category::all(),
            'forum' => $forum,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $validateData = $request->validate([
            'question' => 'required|max:255',
            'forum_category_id' => 'required',
        ]);

        $validateData['user_id'] = auth()->user()->id;

        Forum::where('id', $forum->id)
            ->update($validateData);

        return redirect('/dashboard/forum')->with('success', 'Forum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        Forum::destroy($forum->id);

        return redirect('/dashboard/forum')->with('success', 'Forum berhasil dihapus!');
    }
}