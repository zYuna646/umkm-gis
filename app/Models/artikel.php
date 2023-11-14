<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'keywords', 'deskripsi', 'isi_artikel', 'kategori_artikel_id', 'cover'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['KategoriArtikel'] ?? false, function ($query, $category) {
            $category = KategoriArtikel::where('slug', $category)->first();
            if ($category) {
                $query->where('kategori_artikel_id', $category->id);
            }
        });

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('keywords', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
                        ->orWhere('isi_artikel', 'like', '%' . $search . '%');
        });

        $query->when($filters['category_product'] ?? false, function ($query, $category_product) {
            return $query->whereHas('KategoriArtikel', function ($query) use ($category_product) {
                $query->where('slug', $category_product);
            });
        });

        return $query;
    }

    public function KategoriArtikel()
    {
        return $this->belongsTo(KategoriArtikel::class);
    }
}
