<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Analysis Controller
|--------------------------------------------------------------------------
|
| Controller yang berisi Class AnalysisController dengan berbagai method 
| yang menghubungkan antara View dengan Model Analysis. 
|
*/

class AnalysisController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Index
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view data analysis keseluruhan
    |
    */

    public function index()
    {
        $transaction = Analysis::with('user')->where('user_id', '=', auth()->user()->id)->paginate(10);
        $labels = [];
        $provit = [];
        foreach ($transaction as $data) {
            array_push($labels, $data->created_at->format('d M Y'));
            array_push($provit, ($data->total_income - $data->initial_capital));
        }
        return view('dashboard.analysis.index', [
            'title' => 'Analysis',
            'datas' => Analysis::with('user')->where('user_id', '=', auth()->user()->id)->latest()->paginate(10),
            'labels' => $labels,
            'profit' => $provit
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
                'initial_capital' => 'required|numeric|min:1',
                'total_income' => 'required|numeric|min:1',
                'description' => 'max:255'
            ];

            $validatedData = request()->validate($rules);

            $validatedData['user_id'] = auth()->user()->id;

            Analysis::create($validatedData);

            return back()->with('success', 'Data baru berhasil dibuat!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Data gagal dibuat!') && $validatedData = request()->validate($rules);;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    |
    | Method yang berfungsi untuk menampilkan view edit data analysis secara
    | spesifik berdasarkan id untuk diedit
    |
    */

    public function edit(Analysis $analysis)
    {
        $transaction = Analysis::with('user')->where('id', '=', $analysis->id)->paginate(10);
        $labels = [];
        $modal = [];
        $income = [];
        foreach ($transaction as $data) {
            array_push($labels, $data->created_at->format('d M Y'));
            array_push($modal, $data->initial_capital);
            array_push($income, $data->total_income);
        }
        return view('dashboard.analysis.edit', [
            'title' => 'Edit Analysis',
            'data' => $analysis,
            'labels' => $labels,
            'modal' => $modal,
            'income' => $income,
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

    public function update(Request $request, Analysis $analysis)
    {
        $validatedData = $request->validate([
            'initial_capital' => 'required|numeric|min:1',
            'total_income' => 'required|numeric|min:1',
            'description' => 'max:255'
        ]);

        $validatedData['user_id'] = auth()->user()->id;

        Analysis::where('id', $analysis->id)
            ->update($validatedData);

        return redirect('/dashboard/analysis')->with('success', 'Data berhasil diperbarui!');
    }
}
