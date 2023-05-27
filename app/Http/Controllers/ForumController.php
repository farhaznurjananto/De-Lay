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
        //     @if (now() < $advertisement->end_date && now() > $advertisement->start_date)
        //     <span class="badge text-bg-success }}">Aktif</span>
        // @else
        //     <span class="badge text-bg-danger }}">Tidak Aktif</span>
        // @endif
        $advertisement = Advertisement::where([
            ['end_date', '>', now()],
            ['start_date', '<', now()]
        ])->get();
        if ($advertisement->count()) {
            $advertisement->random(1);
        }
        return view('dashboard.forums', [
            'title' => 'Forums',
            'forums' => Forum::with('user', 'forum_category')->latest()->paginate(5),
            'advertisements' => $advertisement,
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
            'forums' => Forum::with(['user', 'forum_category'])->where('user_id', auth()->user()->id)->latest()->paginate(5),
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
        return view('dashboard.forum.edit', [
            'title' => 'Edit Forum',
            'forum_categories' => Forum_Category::all(),
            'forum' => $forum,
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
