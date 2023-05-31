<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\ValidatedData;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.advertisement.index', [
            'title' => 'Iklan',
            'advertisements' => Advertisement::latest()->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        try {
            $rules = [
                'image_path' => 'required|image|file|max:1024',
                'title' => 'required|max:255',
                'link' => 'max:255',
                'description' => 'max:255',
                'advertising_package' => 'max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                // 'status' => 'required',
            ];

            $validatedData = request()->validate($rules);

            $validatedData['owner_id'] = auth()->user()->id;
            if ($request->file('image_path')) {
                $validatedData['image_path'] = $request->file('image_path')->store('advertisement-images');
            }

            Advertisement::create($validatedData);

            return back()->with('success', 'Iklan baru berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Iklan gagal ditambahkan!') && $validatedData = request()->validate($rules);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        // return $advertisement;
        return view('dashboard.advertisement.show', [
            'title' => 'Detail Iklan',
            'advertisement' => $advertisement,
        ]);
    }

    public function update(Request $request, Advertisement $advertisement)
    {
        try {
            $rules = [
                'image_path' => 'image|file|max:1024',
                'title' => 'required|max:255',
                'link' => 'max:255',
                'description' => 'max:255',
                'advertising_package' => 'max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                // 'status' => 'required',
            ];

            $validatedData = request()->validate($rules);

            $validatedData['owner_id'] = auth()->user()->id;

            if ($request->file('image_path')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $validatedData['image_path'] = $request->file('image_path')->store('advertisement-images');
            }

            Advertisement::where('id', $advertisement->id)
                ->update($validatedData);

            return redirect('/dashboard/advertisement')->with('success', 'Iklan baru berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect('/dashboard/advertisement')->with('error', 'Iklan gagal ditambahkan!') && $validatedData = request()->validate($rules);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        if ($advertisement->image_path) {
            Storage::delete($advertisement->image_path);
        }

        Advertisement::destroy($advertisement->id);

        return redirect('/dashboard/advertisement')->with('success', 'Iklan berhasil dihapus!');
    }
}
