<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoleksiPribadi extends Model
{
    use HasFactory;

    protected $table = 'koleksi_pribadi';
    protected $guarded = ['id'];

    // RELASI DARI MODER USER KE KOLEKSI PRIBADI
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI DARI MODER BUKU KE KOLEKSI PRIBADI
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
