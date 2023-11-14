<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KlasifikasiUsahaController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.KlasifikasiUsaha.index', [
            'title' => 'Klasifikasi Usaha',
            'subtitle' => '',
            'active' => 'KlasifikasiUsaha',
            'datas' => KlasifikasiUsaha::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.KlasifikasiUsaha.create', [
            'title' => 'Klasifikasi Usaha',
            'subtitle' => 'Add Klasifikasi Usaha',
            'active' => 'KlasifikasiUsaha',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'KlasifikasiUsaha_name' => 'required|unique:jenis_usahas,name',
            ],
            [
                'KlasifikasiUsaha_name.required' => 'Klasifikasi Usaha name is required!',
                'KlasifikasiUsaha_name.unique' => 'Klasifikasi Usaha name is already exists!',
            ]
        );

        KlasifikasiUsaha::create([
            'name' => $request->KlasifikasiUsaha_name,
            'slug' => Str::slug($request->KlasifikasiUsaha_name),
        ]);

        return redirect()->route('admin.KlasifikasiUsaha')->with('success', 'Klasifikasi Usaha has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.KlasifikasiUsaha.edit', [
            'title' => 'Klasifikasi Usaha',
            'subtitle' => 'Edit Klasifikasi Usaha',
            'active' => 'KlasifikasiUsaha',
            'data' => KlasifikasiUsaha::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'KlasifikasiUsaha_name' => 'required|unique:jenis_usahas,name,' . $id,
            ],
            [
                'KlasifikasiUsaha_name.required' => 'Klasifikasi Usaha name is required!',
                'KlasifikasiUsaha_name.unique' => 'Klasifikasi Usaha name is already exists!',
            ]
        );

        $KlasifikasiUsaha = KlasifikasiUsaha::findOrFail($id);

        $KlasifikasiUsaha->update([
            'name' => $request->KlasifikasiUsaha_name,
            'slug' => Str::slug($request->KlasifikasiUsaha_name),
        ]);

        return redirect()->route('admin.KlasifikasiUsaha')->with('success', 'Klasifikasi Usaha has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $KlasifikasiUsaha = KlasifikasiUsaha::findOrFail($id);
        $KlasifikasiUsaha->delete();

        return redirect()->route('admin.KlasifikasiUsaha')->with('success', 'Klasifikasi Usaha has been deleted!');
    }
}
