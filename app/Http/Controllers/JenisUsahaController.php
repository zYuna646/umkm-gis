<?php

namespace App\Http\Controllers;

use App\Models\JenisUsaha;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisUsahaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.JenisUsaha.index', [
            'title' => 'Jenis Usaha',
            'subtitle' => '',
            'active' => 'JenisUsaha',
            'datas' => JenisUsaha::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.JenisUsaha.create', [
            'title' => 'Jenis Usaha',
            'subtitle' => 'Add Jenis Usaha',
            'active' => 'JenisUsaha',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, 
            [
                'JenisUsaha_name' => 'required|unique:jenis_usahas,name',
            ],
            [
                'JenisUsaha_name.required' => 'Jenis Usaha name is required!',
                'JenisUsaha_name.unique' => 'Jenis Usaha name is already exists!',
            ]
        );

        JenisUsaha::create([
            'name' => $request->JenisUsaha_name,
            'slug' => Str::slug($request->JenisUsaha_name),
        ]);

        return redirect()->route('admin.JenisUsaha')->with('success', 'Jenis Usaha has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.JenisUsaha.edit', [
            'title' => 'Jenis Usaha',
            'subtitle' => 'Edit Jenis Usaha',
            'active' => 'JenisUsaha',
            'data' => JenisUsaha::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, 
            [
                'JenisUsaha_name' => 'required|unique:jenis_usahas,name,' . $id,
            ],
            [
                'JenisUsaha_name.required' => 'Jenis Usaha name is required!',
                'JenisUsaha_name.unique' => 'Jenis Usaha name is already exists!',
            ]
        );

        $JenisUsaha = JenisUsaha::findOrFail($id);

        $JenisUsaha->update([
            'name' => $request->JenisUsaha_name,
            'slug' => Str::slug($request->JenisUsaha_name),
        ]);

        return redirect()->route('admin.JenisUsaha')->with('success', 'Jenis Usaha has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $JenisUsaha = JenisUsaha::findOrFail($id);
        $JenisUsaha->delete();

        return redirect()->route('admin.JenisUsaha')->with('success', 'Jenis Usaha has been deleted!');
    }
}
