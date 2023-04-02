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
        // return 'forum global';
        return view('dashboard.forums', [
            'title' => 'Forums',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::latest()->paginate(5)->withQueryString(),
        ]);
    }
}
