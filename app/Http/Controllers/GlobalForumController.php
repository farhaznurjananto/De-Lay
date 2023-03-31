<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use App\Models\Forum_Category;
use App\Http\Controllers\Controller;

class GlobalForumController extends Controller
{
    public function index()
    {
        return view('dashboard.forum.global.index', [
            'title' => 'Forum Global',
            'forum_categories' => Forum_Category::all(),
            'forums' => Forum::latest()->paginate(5)->withQueryString(),
        ]);
    }
}
