<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'keywords', 'deskripsi', 'isi_artikel', 'kategori_artikel_id', 'gambar'];
}
