<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBukuRelasi extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku_relasi';
    protected $guarded = ['id'];

    // RELASI DARI MODEL BUKU KE KATEGORI BUKU RELASI
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // RELASI DARI MODEL KATEGORI BUKU KE KATEGORI BUKU RELASI
    public function kategori_buku()
    {
        return $this->belongsTo(KategoriBuku::class);
    }
}
