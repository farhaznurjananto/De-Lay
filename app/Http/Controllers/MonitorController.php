<?php

namespace App\Http\Controllers;

use App\Models\Monitor;
use App\Models\Advertisement;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Monitor Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class MonitorController dengan berbagai method 
| yang menghubungkan antara View dengan Model Monitor. 
|
*/

class MonitorController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data monitor keseluruhan
    |
    */

    public function index()
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

        return view('dashboard.monitor.index', [
            'title' => 'Penjadwalan',
            'monitors' => Monitor::where('user_id', auth()->user()->id)->latest()->paginate(5),
            'advertisement1' => $advertisement1,
            'advertisement2' => $advertisement2,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menyimpan data monitor baru ke database
    |
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

        return back()->with('success', 'Jadwal penanaman berhasil ditambahkan!');
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menghapus data monitor dari database
    |
    */

    public function destroy(Monitor $monitor)
    {
        Monitor::destroy($monitor->id);

        return back()->with('success', 'Jadwal berhasil dihapus!');
    }
}
