<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardForumController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\ProfileController;
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

// INI ZONA ROUTE YANG BISA KEDUANYA

// Home Controller
Route::get('/', [HomeController::class, 'index']);

// Login Controller
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Register Controller
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Profile Controller
Route::resource('/profile', ProfileController::class, ['except' => ['create', 'store', 'show', 'edit', 'destroy']])->middleware('auth');

// Dashboard Controller
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Forum Controller
Route::get('/dashboard/forums', [ForumController::class, 'index'])->middleware('auth');

// Dashboard Forum Controller
Route::resource('/dashboard/forum', DashboardForumController::class, ['except' => ['create']])->middleware('auth');

// Discussion Controller
Route::resource('/dashboard/discussion', DiscussionController::class, ['except' => ['create', 'show', 'edit', 'update']])->middleware('auth');

// INI KUSUS PETANI

// Monitor Controller
Route::resource('/dashboard/monitor', MonitorController::class, ['except' => ['create', 'show', 'edit', 'update']])->middleware('petani');

// INI KUSUS PRODUSEN

// INI ZONA BELUM DI CEK BUAT ROUTE YANG TIDAK BERGUNA

// Dashboard Product Controller
Route::resource('/dashboard/product', DashboardProductController::class, ['except' => ['create']])->middleware('auth');

// Market Controller
Route::get('/dashboard/market', [MarketController::class, 'index'])->middleware('auth');

// Order Controller
Route::resource('/dashboard/order', OrderController::class)->middleware('auth'); //masih kaga bisa
