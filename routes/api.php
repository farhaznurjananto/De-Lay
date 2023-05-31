<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getkey', function () {
    if (session()->has('weather-key')) {
        return response()->json(session()->get('weather-key'));
    }
    return response()->json(false);
});

Route::get("apicuaca", function (Request $request) {
    if (!$request->get('latitude') || !$request->get('longitude')) {
        return response(['message' => "Data tidak lengkap"], 401);
    }
    $apiKey  = "yAWTwoAF4mBrHGVJG7njXJbpjAPU3tc7";
    $latitude = "-8.1733118";
    $longitude = "113.7009312";
    $latitude = $request->get('latitude');
    $longitude = $request->get('longitude');

    $response = Http::get("http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey=$apiKey&q=$latitude%2C$longitude");
    $jsonData = $response->json();

    $locationKey = $jsonData['Key'];

    $response2 = Http::get("http://dataservice.accuweather.com/forecasts/v1/daily/5day/$locationKey?apikey=$apiKey");
    $jsonData2 = $response2->json();

    // return response()->json($jsonData);
    return response()->json($jsonData2);
});
