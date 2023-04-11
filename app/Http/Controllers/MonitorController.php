<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // // Mendapatkan koordinat pengguna dari geolocation HTML5 API
        // $latitude = $_GET['latitude'];
        // $longitude = $_GET['longitude'];

        // // Mengirim permintaan ke API AccuWeather untuk mendapatkan data cuaca
        // $apiKey = config('app.accuweather.api_key');
        // $url = "http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey=$apiKey&q=$latitude%2C$longitude";
        // $response = file_get_contents($url);
        // $data = json_decode($response, true);
        // $locationKey = $data['Key'];

        // $url = "http://dataservice.accuweather.com/forecasts/v1/daily/5day/$locationKey?apikey=$apiKey&metric=true";
        // $response = file_get_contents($url);
        // $data = json_decode($response, true);

        return view('dashboard.monitor.index', [
            'title' => 'Monitoring',
            'monitors' => Monitor::where('user_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
            // 'cuaca' => $data['DailyForecasts'][0]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'penanaman' => 'required|date',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['pemupukan_1'] = date('Y-m-d', strtotime($request['penanaman'] . ' + 30 days'));
        $validatedData['pemupukan_2'] = date('Y-m-d', strtotime($validatedData['pemupukan_1'] . ' + 30 days'));
        $validatedData['pemanenan'] = date('Y-m-d', strtotime($request['penanaman'] . ' + 90 days'));

        Monitor::create($validatedData);

        return redirect()->back()->with('success', 'Jadwal penanaman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Monitor $monitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Monitor $monitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Monitor $monitor)
    {
        Monitor::destroy($monitor->id);

        return redirect()->back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
