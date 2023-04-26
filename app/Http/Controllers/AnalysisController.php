<?php

namespace App\Http\Controllers;

use App\Models\Analysis;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        return view('dashboard.analysis.index', [
            'title' => 'Analysis',
            'datas' => Analysis::with('user')->where('user_id', '=', auth()->user()->id)->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        //
    }

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

    public function show(Analysis $analysis)
    {
        //
    }

    public function edit(Analysis $analysis)
    {
        //
    }

    public function update(Request $request, Analysis $analysis)
    {
        //
    }

    public function destroy(Analysis $analysis)
    {
        //
    }
}
