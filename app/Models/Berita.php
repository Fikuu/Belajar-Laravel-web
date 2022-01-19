<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'judul',
        'gambar',
        'sumber',
        'isi',
        'status',
        'tgl_terbit',
        'view',
        'created_at',
        'updated_at',
    ];
}
