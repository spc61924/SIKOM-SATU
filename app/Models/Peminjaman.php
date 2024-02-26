<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $guarded = ['id'];
    protected $appends = ['tanggal_peminjaman_indo','tanggal_pengembalian_indo'];

    public function getTanggalPeminjamanINdoAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_peminjaman'])->translatedFormat('d F Y');
    }
    public function getTanggalPengembalianINdoAttribute()
    {
        return Carbon::parse($this->attributes['tanggal_pengembalian'])->translatedFormat('d F Y');
    }

    // RELASI DARI MODEL USER KE PEMINJAMAN
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI DARI MODEL BUKU KE PEMINJAMAN
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
