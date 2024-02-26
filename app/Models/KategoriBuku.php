<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'kategori_buku';
    protected $guarded = ['id'];

    // RELASI DARI MODEL KATEGORI BUKU KE KATEGORI BUKU RELASI
    public function kategori_buku_relasi()
    {
        return $this->hasMany(KategoriBukuRelasi::class);
    }
}
