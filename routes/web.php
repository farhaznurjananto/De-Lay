<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
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

// FOR GUEST
Route::get('/', [HomeController::class, 'index']);

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');

// LOGIN - VALIDATE
Route::post('/login', [LoginController::class, 'authenticate']);

// REGISTER
Route::get('/register', [RegisterController::class, 'index']);

// REGISTER - VALIDATE
Route::post('/register', [RegisterController::class, 'store']);

// FOR ALL USER
Route::middleware('auth')->group(function () {
    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index']);

    // PROFILE - UPDATE
    Route::put('/profile/{user}', [ProfileController::class, 'update']);

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // LOGOUT
    Route::post('/logout', [LoginController::class, 'logout']);

    // FORUM
    Route::get('/dashboard/forums', [ForumController::class, 'index']);

    // FORUM - SHOW
    Route::get('/dashboard/forum/{forum}', [ForumController::class, 'show']);

    // FORUM - DESTROY
    Route::delete('/dashboard/forum/{forum}', [ForumController::class, 'destroy']);

    // DISCUSSION - DESTROY
    Route::delete('/dashboard/discussion/{discussion}', [DiscussionController::class, 'destroy']);
});

// FOR FARMER & PRODUSEN
Route::middleware('customer')->group(function () {
    // FORUM - USER
    Route::get('/dashboard/forum', [ForumController::class, 'index_user']);

    // FORUM - STORE
    Route::post('/dashboard/forum', [ForumController::class, 'store']);

    // FORUM - EDIT
    Route::get('/dashboard/forum/{forum}/edit', [ForumController::class, 'edit']);

    // FORUM - UPDATE
    Route::put('/dashboard/forum/{forum}', [ForumController::class, 'update']);

    // DISCUSSION - STORE
    Route::post('/dashboard/discussion', [DiscussionController::class, 'store']);

    // ORDER
    Route::get('/dashboard/order', [OrderController::class, 'index']);

    // ORDER - SHOW
    Route::get('/dashboard/order/{order}', [OrderController::class, 'show']);

    // ORDER - UPDATE
    Route::put('/dashboard/order/{order}', [OrderController::class, 'update']);

    // ANALYSIS
    Route::get('/dashboard/analysis', [AnalysisController::class, 'index']);

    // ANALYSIS - STORE
    Route::post('/dashboard/analysis', [AnalysisController::class, 'store']);

    // ANALYSIS - EDIT
    Route::get('/dashboard/analysis/{analysis}/edit', [AnalysisController::class, 'edit']);

    // ANALYSIS - UPDATE
    Route::put('/dashboard/analysis/{analysis}', [AnalysisController::class, 'update']);
});

// FOR FARMER
Route::middleware('farmer')->group(function () {
    // MONITOR
    Route::get('/dashboard/monitor', [MonitorController::class, 'index']);

    // MONITOR - STORE
    Route::post('/dashboard/monitor', [MonitorController::class, 'store']);

    // MONITOR - DESTROY
    Route::delete('/dashboard/monitor/{monitor}', [MonitorController::class, 'destroy']);

    // PRODUCT
    Route::get('/dashboard/product', [ProductController::class, 'index']);

    // PRODUCT - STORE
    Route::post('/dashboard/product', [ProductController::class, 'store']);

    // PRODUCT - EDIT
    Route::get('/dashboard/product/{product}/edit', [ProductController::class, 'edit']);

    // PRODUCT - UPDATE
    Route::put('/dashboard/product/{product}', [ProductController::class, 'update']);

    // PRODUCT - DESTROY
    Route::delete('/dashboard/product/{product}', [ProductController::class, 'destroy']);
});

// FOR PRODUSEN
Route::middleware('produsen')->group(function () {
    // balikin ke customer kalau mau pakai riwayat di petani
    // ORDER - HISTORIES
    Route::get('/dashboard/history', [OrderController::class, 'history']);

    // PRODUCT - MARKET
    Route::get('/dashboard/market', [ProductController::class, 'market']);

    // ORDER - CREATE
    Route::get('/dashboard/market/{product}', [OrderController::class, 'create']);

    // ORDER - STORE
    Route::post('/dashboard/market', [OrderController::class, 'store']);

    // ORDER - EDIT
    Route::get('/dashboard/order/{order}/edit', [OrderController::class, 'edit']);

    // ORDER - DESTROY
    Route::delete('/dashboard/order/{order}', [OrderController::class, 'destroy']);
});

// FOR ADMIN
Route::middleware('admin')->group(function () {
    // ADVERTISEMENT
    Route::get('/dashboard/advertisement', [AdvertisementController::class, 'index']);

    // ADVERTISEMENT - STORE
    Route::post('/dashboard/advertisement', [AdvertisementController::class, 'store']);

    // ADVERTISEMENT - SHOW
    Route::get('/dashboard/advertisement/{advertisement}', [AdvertisementController::class, 'show']);

    // ADVERTISEMENT - UPDATE
    Route::put('/dashboard/advertisement/{advertisement}', [AdvertisementController::class, 'update']);

    // ADVERTISEMENT - DESTROY
    Route::delete('/dashboard/advertisement/{advertisement}', [AdvertisementController::class, 'destroy']);
});
