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
        foreach ($collection as $index => $value) {
            $koordinat_maps = $value['1'];
            list($latitude, $longitude) = explode("  Lang: ", str_replace("Lat: ", "", $koordinat_maps));
            $point = DB::raw("POINT($latitude, $longitude)");

            if ($index == 0) {

            } else {
                UMKM::create([
                    'alamat' => $value['0'],
                    'kordinat' => $point,
                    'nama_pemilik' => $value['2'],
                    'desa' => $value['3'],
                    'kecamatan' => $value['4'],
                    'kabupaten' => $value['5'],
                    'jenis_usaha_id' => $value['6'],
                    'klasifikasi_usaha_id' => $value['7'],
                    'pendapatan_aset' => $value['8'],
                    'pendapatan_omset' => $value['9'],
                    'tenaga_kerja_l' => $value['10'],
                    'tenaga_kerja_p' => $value['11'],
                    'jumlah_tenaga_kerja' => $value['12'],
                    'keterangan_jenis_usaha' => $value['13'],
                    'keterangan' => $value['14'],
                    'is_Aktif' => $value['15'] !== null ? true : false,
                    'is_Umum' => $value['16'] !== null ? true : false,
                    'is_Bantuan' => $value['17'] !== null ? true : false,
                ]);
            }


        }
    }
}
