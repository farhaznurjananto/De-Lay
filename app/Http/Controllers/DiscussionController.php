<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiscussionController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'message' => 'required|max:255',
            'forum_id' => 'required'
        ]);

        $validateData['sender_id'] = auth()->user()->id;
        $validateData['forum_id'] = $request['forum_id'];

        Discussion::create($validateData);

        return redirect()->back()->with('success', 'Pesan berhasil ditambahkan!');
    }

    public function destroy(Discussion $discussion)
    {
        // return $discussion->id;
        Discussion::destroy($discussion->id);

        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
}
