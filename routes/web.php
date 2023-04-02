<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardForumController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/forums', [ForumController::class, 'index'])->middleware('auth');
Route::resource('/dashboard/forum', DashboardForumController::class, ['except' => ['create']])->middleware('auth');
Route::resource('/dashboard/discussion', DiscussionController::class, ['except' => ['create', 'show', 'edit', 'update']])->middleware('auth');

Route::resource('/dashboard/product', DashboardProductController::class, ['except' => ['create']])->middleware('auth');

Route::resource('/dashboard/monitor', MonitorController::class, ['except' => ['create', 'show', 'edit', 'update']])->middleware('petani');
