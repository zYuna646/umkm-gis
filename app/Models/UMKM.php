<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    use HasFactory;
    protected $fillable = [
        'is_Aktif',
        'is_Umum',
        'is_Bantuan',
        'alamat',
        'desa',
        'nama_pemilik',
        'kecamatan',
        'kabupaten',
        'pendapatan_aset',
        'pendapatan_omset',
        'tenaga_kerja_l',
        'tenaga_kerja_p',
        'jumlah_tenaga_kerja',
        'keterangan_jenis_usaha',
        'keterangan',
        'kordinat',
        'jenis_usaha_id',
        'klasifikasi_usaha_id'
    ];
    
}
