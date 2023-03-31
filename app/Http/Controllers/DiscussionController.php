<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Models\Forum_Category;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.discussion.index', [
            'title' => 'Forum Global',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::latest()->paginate(5)->withQueryString(),
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
        // return $request;
        $validateData = $request->validate([
            'message' => 'required|max:255',
            'forum_id' => 'required'
        ]);

        $validateData['sender_id'] = auth()->user()->id;
        $validateData['forum_id'] = $request['forum_id'];

        Discussion::create($validateData);

        return redirect()->back();
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
    public function edit(Discussion $discussion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discussion $discussion)
    {
        // return $discussion->id;
        Discussion::destroy($discussion->id);

        return redirect()->back();
    }
}
