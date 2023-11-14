<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\KategoriArtikel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class artikelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.artikel.index', [
            'title' => 'Artikel',
            'subtitle' => '',
            'active' => 'artikel',
            'datas' => artikel::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $KategoriArtikel = KategoriArtikel::all();
        return view('admin.master-data.artikel.create', [
            'title' => 'Artikel',
            'subtitle' => 'Add Artikel',
            'active' => 'artikel',
            'KategoriArtikel' => $KategoriArtikel
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
                'parent' => 'required',
                'judul' => 'required',
                'keywords' => 'required',
                'deskripsi' => 'required',
                'isi_artikel' => 'required',

            ],
            [
                'parent.required' => 'Artikel name is required!',
            ]
        );

        artikel::create([
            'title' => $request->judul,
            'kategori_artikel_id' => $request->kategori_artikel_id,
            'keywords' => $request->keywords,
            'deskkripsi' => $request->deskripsi,
            'isi_artikel' => $request->isi_artikel
        ]);

        return redirect()->route('admin.artikel')->with('success', 'Artikel has been added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('admin.master-data.artikel.edit', [
            'title' => 'Artikel',
            'subtitle' => 'Edit Artikel',
            'active' => 'artikel',
            'data' => artikel::findOrFail($id),
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
                'artikel_name' => 'required|unique:jenis_usahas,name,' . $id,
            ],
            [
                'artikel_name.required' => 'Artikel name is required!',
                'artikel_name.unique' => 'Artikel name is already exists!',
            ]
        );

        $artikel = artikel::findOrFail($id);

        $artikel->update([
            'name' => $request->artikel_name,
            'slug' => Str::slug($request->artikel_name),
        ]);

        return redirect()->route('admin.artikel')->with('success', 'Artikel has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artikel = artikel::findOrFail($id);
        $artikel->delete();

        return redirect()->route('admin.artikel')->with('success', 'Artikel has been deleted!');
    }
}
