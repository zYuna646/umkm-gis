<?php

namespace App\Http\Controllers;

use App\Models\artikel;
use App\Models\JenisUsaha;
use App\Models\KategoriArtikel;
use App\Models\KlasifikasiUsaha;
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
                'cover' => 'required|image|mimes:png,jpg,jpeg',
            ],
            [
                'parent.required' => 'Artikel name is required!',
            ]
        );

        $image = $request->file('cover');
        $image_name = time() . '-' . rand(1, 100) . '-' . $request->judul . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

        artikel::create([
            'title' => $request->judul,
            'kategori_artikel_id' => $request->parent,
            'keywords' => $request->keywords,
            'deskripsi' => $request->deskripsi,
            'isi_artikel' => $request->isi_artikel,
            'cover' => $image_name
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
            'KategoriArtikel' => KategoriArtikel::all()
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

        $artikel = artikel::findOrFail($id);
        $image = $request->file('cover');


        if ($image != null) {
            $image_name = time() . '-' . rand(1, 100) . '-' . $request->judul . '.' . $image->extension();
            $image->move(public_path('uploads/catalog/image'), $image_name);

            $artikel->update([
                'title' => $request->judul,
                'kategori_artikel_id' => $request->parent,
                'keywords' => $request->keywords,
                'deskripsi' => $request->deskripsi,
                'isi_artikel' => $request->isi_artikel,
                'cover' => $image_name
            ]);

        } else {
            $artikel->update([
                'title' => $request->judul,
                'kategori_artikel_id' => $request->parent,
                'keywords' => $request->keywords,
                'deskripsi' => $request->deskripsi,
                'isi_artikel' => $request->isi_artikel,
            ]);
        }



        return redirect()->route('admin.artikel')->with('success', 'Artikel has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $artikel = artikel::findOrFail($id);
        $productImage = $artikel->cover;
        if ($productImage) {
            unlink(public_path('uploads/catalog/image/' . $productImage));
        }

        $artikel->delete();

        return redirect()->route('admin.artikel')->with('success', 'Artikel has been deleted!');
    }
}
