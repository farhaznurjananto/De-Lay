<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Forum_Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function index()
    {
        return view('dashboard.forums', [
            'title' => 'Forums',
            'forums' => Forum::with('user', 'forum_category')->latest()->paginate(5),
        ]);
    }

    public function index_user()
    {
        return view('dashboard.forum.index', [
            'title' => 'Forum',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::with(['user', 'forum_category'])->where('user_id', auth()->user()->id)->latest()->paginate(5),
        ]);
    }

    public function store()
    {
        try {
            $rules = [
                'question' => 'required|max:255',
                'forum_category_id' => 'required',
            ];

            $validateData = request()->validate($rules);

            $validateData['user_id'] = auth()->user()->id;

            Forum::create($validateData);

            return back()->with('success', 'Forum baru berhasil dibuat!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Forum gagal dibuat!') && $validateData = request()->validate($rules);;
        }
    }

    public function show(Forum $forum)
    {
        return view('dashboard.forum.show', [
            'title' => 'Forum',
            'forum' => $forum,
            'discussions' => Discussion::with(['user'])->where('forum_id', $forum->id)->latest()->paginate(5),
        ]);
    }

    public function edit(Forum $forum)
    {
        return view('dashboard.forum.edit', [
            'title' => 'Edit Forum',
            'forum_categories' => Forum_Category::all(),
            'forum' => $forum,
        ]);
    }

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

    public function destroy(Forum $forum)
    {
        Forum::destroy($forum->id);

        return redirect('/dashboard/forum')->with('success', 'Forum berhasil dihapus!');
    }
}
