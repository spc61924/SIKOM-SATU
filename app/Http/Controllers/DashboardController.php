<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\UlasanBuku;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_buku = Buku::count();$total_peminjam = Peminjaman::count();
        $total_ulasan = UlasanBuku::count();$total_pengguna = User::count();

        return view('Dashboard.index', [
            'total_buku' => $total_buku,
            'total_peminjam' => $total_peminjam,
            'total_ulasan' => $total_ulasan,
            'total_pengguna' => $total_pengguna,
        ]);    }
}
