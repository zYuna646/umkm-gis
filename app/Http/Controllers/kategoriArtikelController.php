<?php

namespace App\Http\Controllers;

use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class kategoriArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.KategoriArtikel.index', [
            'title' => 'Kategori Artikel',
            'subtitle' => '',
            'active' => 'KategoriArtikel',
            'datas' => KategoriArtikel::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master-data.KategoriArtikel.create', [
            'title' => 'Kategori Artikel',
            'subtitle' => 'Add Kategori Artikel',
            'active' => 'KategoriArtikel',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'KategoriArtikel_name' => 'required|unique:jenis_usahas,name',
            ],
            [
                'KategoriArtikel_name.required' => 'Kategori Artikel name is required!',
                'KategoriArtikel_name.unique' => 'Kategori Artikel name is already exists!',
            ]
        );

        KategoriArtikel::create([
            'name' => $request->KategoriArtikel_name,
            'slug' => Str::slug($request->KategoriArtikel_name),
        ]);

        return redirect()->route('admin.KategoriArtikel')->with('success', 'Kategori Artikel has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.KategoriArtikel.edit', [
            'title' => 'Kategori Artikel',
            'subtitle' => 'Edit Kategori Artikel',
            'active' => 'KategoriArtikel',
            'data' => KategoriArtikel::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'KategoriArtikel_name' => 'required|unique:jenis_usahas,name,' . $id,
            ],
            [
                'KategoriArtikel_name.required' => 'Kategori Artikel name is required!',
                'KategoriArtikel_name.unique' => 'Kategori Artikel name is already exists!',
            ]
        );

        $KategoriArtikel = KategoriArtikel::findOrFail($id);

        $KategoriArtikel->update([
            'name' => $request->KategoriArtikel_name,
            'slug' => Str::slug($request->KategoriArtikel_name),
        ]);

        return redirect()->route('admin.KategoriArtikel')->with('success', 'Kategori Artikel has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $KategoriArtikel = KategoriArtikel::findOrFail($id);
        $KategoriArtikel->delete();

        return redirect()->route('admin.KategoriArtikel')->with('success', 'Kategori Artikel has been deleted!');
    }
}
