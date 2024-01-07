<?php

namespace App\Http\Controllers;

use App\Imports\UMKMImportClass;
use App\Models\JenisUsaha;
use App\Models\KlasifikasiUsaha;
use App\Models\UMKM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use Maatwebsite\Excel\Facades\Excel;


class UMKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klasifikasiUsaha = KlasifikasiUsaha::all();
        $jenisUsaha = JenisUsaha::all();
        return view('admin.master-data.umkm.index', [
            'title' => 'UMKM',
            'subtitle' => '',
            'active' => 'umkm',
            'datas' => UMKM::latest()->get(),
            'jenisUsaha' => $jenisUsaha,
            'klasifikasiUsaha' => $klasifikasiUsaha,
            'fields' => [
                'Aktif',
                'Umum',
                'Bantuan',
                'Alamat',
                'Desa',
                'Kecamatan',
                'Kabupaten',
                'Pendapatan Aset',
                'Pendapatan Omset',
                'Tenaga Kerja L',
                'Tenaga Kerja P',
                'Jumlah Tenaga Kerja',
                'Jenis Usaha',
                'Klasifikasi Usaha',
                'Status',
            ],
        ]);
    }

    public function permintaan()
    {
        return view('admin.master-data.umkm.permintaan', [
            'title' => 'Verifikasi UMKM',
            'subtitle' => '',
            'active' => 'permintaan',
            'datas' => UMKM::Where('status', 'proses')->get(),
            'fields' => [
                'Aktif',
                'Umum',
                'Bantuan',
                'Alamat',
                'Desa',
                'Kecamatan',
                'Kabupaten',
                'Pendapatan Aset',
                'Pendapatan Omset',
                'Tenaga Kerja L',
                'Tenaga Kerja P',
                'Jumlah Tenaga Kerja',
                'Jenis Usaha',
                'Klasifikasi Usaha',
                'Status',
            ]
        ]);
    }

    public function status(Request $request, $id, $status, $message)
    {

        $umkm = umkm::findOrFail($id);


        if ($request->keterangan != null) {
            $umkm->update([
                'status' => $status,
                'message' => $request->keterangan
            ]);
        } else {
            $umkm->update([
                'status' => $status,
                'message' => $message
            ]);
        }



        return redirect()->route('admin.umkm.permintaan')->with('success', 'UMKM berhasil di ' . $status);
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
            'title' => 'UMKM',
            'subtitle' => 'Add UMKM',
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
                'foto' => 'required|image|mimes:png,jpg,jpeg',
                'link' => 'required'

            ],
            [
                'alamat.required' => 'harap mengisi alamat!',
            ]
        );


        $koordinat_maps = $request->input('kordinat_maps');
        list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
        $point = DB::raw("POINT($latitude, $longitude)");

        $image = $request->file('foto');
        $image_name = time() . '-' . rand(1, 100) . '-' . $request->nama_pemilik . '.' . $image->extension();
        $image->move(public_path('uploads/catalog/image'), $image_name);

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
            'link' => $request->input('link'),
            'foto' => $image_name
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
            'title' => 'UMKM',
            'subtitle' => 'Edit UMKM',
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
                'link' => 'required'

            ],
            [
                'alamat.required' => 'harap mengisi alamat!',
            ]
        );


        $koordinat_maps = $request->input('kordinat_maps');
        list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
        $point = DB::raw("POINT($latitude, $longitude)");

        $umkm = umkm::findOrFail($id);

        $image = $request->file('cover');


        if ($image != null) {
            $image_name = time() . '-' . rand(1, 100) . '-' . $request->nama_pemilik . '.' . $image->extension();
            $image->move(public_path('uploads/catalog/image'), $image_name);

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
                'link' => $request->input('link'),
                'foto' => $image_name
            ]);

        } else {
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
                'link' => $request->input('link')
            ]);
        }




        if ($umkm->status == 'tolak') {
            $umkm->Update([
                'status' => 'proses'
            ]);
        }


        return redirect()->route('admin.umkm')->with('success', 'umkm has been updated!');
    }

    public function report(Request $request)
    {

        $this->validate(
            $request,
            [
                'start_date' => 'required',
            ],
            [
            ]
        );

        $start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
        $option = $request->options;

        if ($request->has('end_date') && !empty($request->end_date)) {
            $end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');
            $produksi = UMKM::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $produksi = UMKM::whereDate('created_at', $start_date)->get();
        }
        $data = [
            'umkms' => $produksi->where('status', 'terima'),
            'fields' => [
                'Aktif' => 'is_Aktif',
                'Umum' => 'is_Umum',
                'Bantuan' => 'is_Bantuan',
                'Alamat' => 'alamat',
                'Desa' => 'desa',
                'Kecamatan' => 'kecamatan',
                'Kabupaten' => 'kabupaten',
                'Pendapatan Aset' => 'pendapatan_aset',
                'Pendapatan Omset' => 'pendapatan_omset',
                'Tenaga Kerja L' => 'tenaga_kerja_l',
                'Tenaga Kerja P' => 'tenaga_kerja_p',
                'Jumlah Tenaga Kerja' => 'jumlah_tenaga_kerja',
                'Jenis Usaha' => 'jenis_usaha_id',
                'Klasifikasi Usaha' => 'klasifikasi_usaha_id',
                'Status' => 'status',
            ],
            'data' => $option,
        ];

        $pdf = PDF::loadView('admin.master-data.umkm.report', $data)->setPaper('A4', 'portrait');
        return $pdf->download('Laporan UMKM.pdf');

    }

    public function pengajuan(Request $request)
    {
        $this->validate(
            $request,
            [
                'start_date' => 'required',
            ],
            [
            ]
        );

        $start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
        $option = $request->options;


        if ($request->has('end_date') && !empty($request->end_date)) {
            $end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');
            $produksi = UMKM::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $produksi = UMKM::whereDate('created_at', $start_date)->get();
        }
        $data = [
            'umkms' => $produksi,
            'fields' => [
                'Aktif' => 'is_Aktif',
                'Umum' => 'is_Umum',
                'Bantuan' => 'is_Bantuan',
                'Alamat' => 'alamat',
                'Desa' => 'desa',
                'Kecamatan' => 'kecamatan',
                'Kabupaten' => 'kabupaten',
                'Pendapatan Aset' => 'pendapatan_aset',
                'Pendapatan Omset' => 'pendapatan_omset',
                'Tenaga Kerja L' => 'tenaga_kerja_l',
                'Tenaga Kerja P' => 'tenaga_kerja_p',
                'Jumlah Tenaga Kerja' => 'jumlah_tenaga_kerja',
                'Jenis Usaha' => 'jenis_usaha_id',
                'Klasifikasi Usaha' => 'klasifikasi_usaha_id',
                'Status' => 'status',
            ],
            'data' => $option,
        ];

        $pdf = PDF::loadView('admin.master-data.umkm.pengajuan', $data)->setPaper('A4', 'portrait');
        return $pdf->download('Laporan UMKM.pdf');

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
