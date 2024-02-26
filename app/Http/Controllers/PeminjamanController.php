<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with('user', 'buku')->get();
        return view('Peminjaman.index')->with('data', $data);
    }

    public function create()
    {
        $users = User::all();
        $books = Buku::all();
        return view('Peminjaman.create')
        ->with('users', $users)
        ->with('books', $books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required|date_format:Y/m/d',
            'tanggal_pengembalian' => 'required|date_format:Y/m/d',
            'status_peminjaman' => 'required',
        ], [
            'user_id.required' => 'Pengguna Wajib Diisi',
            'buku_id.required' => 'Buku Wajib Diisi',
            'tanggal_peminjaman.required' => 'Tanggal Peminjaman Wajib Diisi',
            'tanggal_pengembalian.required' => 'Tanggal Pengembalian Wajib Diisi',
            'status_peminjaman.required' => 'Status Peminjaman Wajib Diisi',
        ]);

        $user = Auth::user()->id;

        $data = [
            'user_id' => $user,
            'buku_id' => $request->buku_id,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => $request->status_peminjaman
        ];

        Peminjaman::create($data);
        return redirect('data-peminjaman')->with('success', 'Berhasil memasukan data');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
