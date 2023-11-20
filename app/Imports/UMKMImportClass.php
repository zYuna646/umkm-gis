<?php

namespace App\Imports;

use App\Models\UMKM;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class UMKMImportClass implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $value) {

            $koordinat_maps = $value('kordinat');
            list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
            $point = DB::raw("POINT($latitude, $longitude)");

            UMKM::create([
                'alamat' => $value['alamat'],
                'kordinat' => $point,
                'nama_pemilik' => $value['nama_pemilik'],
                'desa' => $value['desa'],
                'kecamatan' => $value['kecamatan'],
                'kabupaten' => $value['kabupaten'],
                'jenis_usaha_id' => $value['jenis_usaha'],
                'klasifikasi_usaha_id' => $value['klasifikasi_usaha'],
                'pendapatan_aset' => $value['pendapatan-aset'],
                'pendapatan_omset' => $value['pendapatan-omset'],
                'tenaga_kerja_l' => $value['tenaga-kerja-l'],
                'tenaga_kerja_p' => $value['tenaga-kerja-p'],
                'jumlah_tenaga_kerja' => $value['jumlah-tenaga-kerja'],
                'keterangan_jenis_usaha' => $value['keterangan-jenis-usaha'],
                'keterangan' => $value['keterangan'],
                'is_Aktif' => $value['is-aktif'] !== null ? true : false,
                'is_Umum' => $value['is-umum'] !== null ? true : false,
                'is_Bantuan' => $value['bantuan'] !== null ? true : false,
            ]);
        }
    }
}
