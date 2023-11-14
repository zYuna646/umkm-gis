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


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['JenisUsaha'] ?? false, function ($query, $category) {
            $category = JenisUsaha::where('slug', $category)->first();
            if ($category) {
                $query->where('jenis_usaha_id', $category->id);
            }
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('nama_pemilik', 'like', '%' . $search . '%')
                ->orWhere('alamat', 'like', '%' . $search . '%')
                ->orWhere('desa', 'like', '%' . $search . '%')
                ->orWhere('kecamatan', 'like', '%' . $search . '%')
                ->orWhere('kabupaten', 'like', '%' . $search . '%')
                ->orWhere('keterangan_jenis_usaha', 'like', '%' . $search . '%')
                ->orWhere('kordinat', 'like', '%' . $search . '%');
        });



        return $query;
    }

    public function JenisUsaha()
    {
        return $this->belongsTo(JenisUsaha::class);
    }

    public function KlasifikasiUsaha()
    {
        return $this->belongsTo(KlasifikasiUsaha::class);
    }
}
