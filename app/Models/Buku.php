<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $guarded = ['id'];

    // Translate Formate ke Indonesia
    protected $appends = ['tanggal_input_indo'];

    public function getTanggalInputINdoAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y');
    }

    // RELASI DARI MODEL BUKU KE KATEGORI BUKU RELASI
    public function kategori_buku_relasi()
    {
        return $this->hasMany(KategoriBukuRelasi::class);
    }

    // RELASI DARI MODEL BUKU KE PEMINJAMAN
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // RELASI DARI MODER BUKU KE KOLEKSI PRIBADI
    public function koleksi_pribadi()
    {
        return $this->hasMany(KoleksiPribadi::class);
    }

    // RELASI DARI MODEL BUKU KE ULASAN BUKU
    public function ulasan_buku()
    {
        return $this->hasMany(UlasanBuku::class);
    }
}
