<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'username',
        'email',
        'password',
        'nama_lengkap',
        'alamat',
        'role',
        'verifikasi',
    ];

    // RELASI DARI MODEL USER KE PEMINJAMAN
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // RELASI DARI MODER USER KE KOLEKSI PRIBADI
    public function koleksi_pribadi()
    {
        return $this->hasMany(KoleksiPribadi::class);
    }

    // RELASI DARI MODEL USER KE ULASAN BUKU
    public function ulasan_buku()
    {
        return $this->hasMany(UlasanBuku::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
