<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasifikasiUsaha extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];
}
