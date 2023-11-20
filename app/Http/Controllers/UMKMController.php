<?php

namespace App\Http\Controllers;

use App\Imports\UMKMImportClass;
use App\Models\JenisUsaha;
use App\Models\KlasifikasiUsaha;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Facades\Excel;


class UMKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.master-data.umkm.index', [
            'title' => 'umkm',
            'subtitle' => '',
            'active' => 'umkm',
            'datas' => UMKM::latest()->get(),
        ]);
    }

    public function import(Request $request)
    {
        $this->validate(
            $request,
            [
                'excel' => 'required',
            ]
        );

        Excel::import(new UMKMImportClass, $request->file('excel'));


        return redirect()->route('admin.umkm')->with('success', 'Data imported successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $JenisUsaha = JenisUsaha::all();
        $KlasifikasiUsaha = KlasifikasiUsaha::all();
        return view('admin.master-data.umkm.create', [
            'title' => 'umkm',
            'subtitle' => 'Add umkm',
            'active' => 'umkm',
            'JenisUsaha' => $JenisUsaha,
            'KlasifikasiUsaha' => $KlasifikasiUsaha,
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
                'alamat' => 'required',
                'kordinat_maps' => 'required',
                'nama_pemilik' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'jenis_usaha' => 'required',
                'klasifikasi_usaha' => 'required',
                'pendapatan-aset' => 'required',
                'pendapatan-omset' => 'required',
                'tenaga-kerja-l' => 'required',
                'tenaga-kerja-p' => 'required',
                'keterangan-jenis-usaha' => 'required',
                'keterangan' => 'required',
                'jumlah-tenaga-kerja' => 'required',

            ],
            [
                'alamat.required' => 'harap mengisi alamat!',
            ]
        );


        $koordinat_maps = $request->input('kordinat_maps');
        list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
        $point = DB::raw("POINT($latitude, $longitude)");

        umkm::create([
            'alamat' => $request->alamat,
            'kordinat' => $point,
            'nama_pemilik' => $request->nama_pemilik,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'jenis_usaha_id' => $request->input('jenis_usaha'),
            'klasifikasi_usaha_id' => $request->input('klasifikasi_usaha'),
            'pendapatan_aset' => $request->input('pendapatan-aset'),
            'pendapatan_omset' => $request->input('pendapatan-omset'),
            'tenaga_kerja_l' => $request->input('tenaga-kerja-l'),
            'tenaga_kerja_p' => $request->input('tenaga-kerja-p'),
            'jumlah_tenaga_kerja' => $request->input('jumlah-tenaga-kerja'),
            'keterangan_jenis_usaha' => $request->input('keterangan-jenis-usaha'),
            'keterangan' => $request->input('keterangan'),
            'is_Aktif' => $request->input('is-aktif') !== null ? true : false,
            'is_Umum' => $request->input('is-umum') !== null ? true : false,
            'is_Bantuan' => $request->input('bantuan') !== null ? true : false,

        ]);

        return redirect()->route('admin.umkm')->with('success', 'umkm has been added!');
    }

    public function download()
    {
        $path = public_path('uploads/' . 'template_umkm.xlsx');

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            abort(404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $JenisUsaha = JenisUsaha::all();
        $KlasifikasiUsaha = KlasifikasiUsaha::all();

        return view('admin.master-data.umkm.edit', [
            'title' => 'umkm',
            'subtitle' => 'Edit umkm',
            'active' => 'umkm',
            'data' => umkm::findOrFail($id),
            'JenisUsaha' => $JenisUsaha,
            'KlasifikasiUsaha' => $KlasifikasiUsaha,
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
                'alamat' => 'required',
                'kordinat_maps' => 'required',
                'nama_pemilik' => 'required',
                'desa' => 'required',
                'kecamatan' => 'required',
                'kabupaten' => 'required',
                'jenis_usaha' => 'required',
                'klasifikasi_usaha' => 'required',
                'pendapatan-aset' => 'required',
                'pendapatan-omset' => 'required',
                'tenaga-kerja-l' => 'required',
                'tenaga-kerja-p' => 'required',
                'keterangan-jenis-usaha' => 'required',
                'keterangan' => 'required',
                'jumlah-tenaga-kerja' => 'required',

            ],
            [
                'alamat.required' => 'harap mengisi alamat!',
            ]
        );


        $koordinat_maps = $request->input('kordinat_maps');
        list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
        $point = DB::raw("POINT($latitude, $longitude)");

        $umkm = umkm::findOrFail($id);

        $umkm->update([
            'alamat' => $request->alamat,
            'kordinat' => $point,
            'nama_pemilik' => $request->nama_pemilik,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'jenis_usaha_id' => $request->input('jenis_usaha'),
            'klasifikasi_usaha_id' => $request->input('klasifikasi_usaha'),
            'pendapatan_aset' => $request->input('pendapatan-aset'),
            'pendapatan_omset' => $request->input('pendapatan-omset'),
            'tenaga_kerja_l' => $request->input('tenaga-kerja-l'),
            'tenaga_kerja_p' => $request->input('tenaga-kerja-p'),
            'jumlah_tenaga_kerja' => $request->input('jumlah-tenaga-kerja'),
            'keterangan_jenis_usaha' => $request->input('keterangan-jenis-usaha'),
            'keterangan' => $request->input('keterangan'),
            'is_Aktif' => $request->input('is-aktif') !== null ? true : false,
            'is_Umum' => $request->input('is-umum') !== null ? true : false,
            'is_Bantuan' => $request->input('bantuan') !== null ? true : false,
        ]);


        return redirect()->route('admin.umkm')->with('success', 'umkm has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkm = umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->route('admin.umkm')->with('success', 'umkm has been deleted!');
    }
}
