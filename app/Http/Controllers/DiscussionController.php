<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Analysis Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class AnalysisController dengan berbagai method 
| yang menghubungkan antara View dengan Model Analysis. 
|
*/

class DiscussionController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan data discussion baru ke database
    |
    */

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

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menghapus data discussion dari database
    |
    */

    public function destroy(Discussion $discussion)
    {
        // return $discussion->id;
        Discussion::destroy($discussion->id);

        return redirect()->back()->with('success', 'Pesan berhasil dihapus!');
    }
}
