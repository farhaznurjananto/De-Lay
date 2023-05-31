<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Forum_Category;
use App\Models\Discussion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertisement;

/*
|--------------------------------------------------------------------------
| Forum Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class ForumController dengan berbagai method 
| yang menghubungkan antara View dengan Model Forum. 
|
*/

class ForumController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data forum keseluruhan
    |
    */

    public function index()
    {
        return view('dashboard.forums', [
            'title' => 'Forum Global',
            'forums' => Forum::with('user', 'forum_category')->latest()->paginate(6),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Index User
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data forum milih user 
    | secara spesifik
    |
    */

    public function index_user()
    {
        return view('dashboard.forum.index', [
            'title' => 'Forum',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::with(['user', 'forum_category'])->where('user_id', auth()->user()->id)->latest()->paginate(6),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan data analysis baru ke database
    |
    */

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

    /*
    |--------------------------------------------------------------------------
    | Show
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view forum secara spesifik
    | berdasarkan id
    |
    */

    public function show(Forum $forum)
    {
        return view('dashboard.forum.show', [
            'title' => 'Forum',
            'forum' => $forum,
            'discussions' => Discussion::with(['user'])->where('forum_id', $forum->id)->latest()->paginate(5),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view edit data forum secara
    | spesifik berdasarkan id untuk diedit
    |
    */

    public function edit(Forum $forum)
    {
        // ADVERTISEMENT
        $advertisement1 = Advertisement::where([
            ['end_date', '>', now()],
            ['start_date', '<', now()],
            ['advertising_package', '=', 'I']
        ])->get();
        if ($advertisement1->count()) {
            $advertisement1->random(1);
        }

        $advertisement2 = Advertisement::where([
            ['end_date', '>', now()],
            ['start_date', '<', now()],
            ['advertising_package', '=', 'II']
        ])->get();
        if ($advertisement2->count()) {
            $advertisement2->random(1);
        }

        return view('dashboard.forum.edit', [
            'title' => 'Ubah Forum',
            'forum_categories' => Forum_Category::all(),
            'forum' => $forum,
            'advertisement1' => $advertisement1,
            'advertisement2' => $advertisement2,
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

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menghapus data forum dari database
    |
    */

    public function destroy(Forum $forum)
    {
        $url = '/dashboard/forum';
        Forum::destroy($forum->id);

        if (auth()->user()->is_admin == 1) {
            $url = '/dashboard/forums';
        }

        return redirect($url)->with('success', 'Forum berhasil dihapus!');
    }
}
