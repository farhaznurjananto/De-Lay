<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
    public function index()
    {
        return view('dashboard.monitor.index', [
            'title' => 'Monitoring',
            'monitors' => Monitor::where('user_id', auth()->user()->id)->latest()->paginate(5)->withQueryString(),
        ]);
    }

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

        return back()->with('success', 'Jadwal penanaman berhasil ditambahkan!');
    }

    public function destroy(Monitor $monitor)
    {
        Monitor::destroy($monitor->id);

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
