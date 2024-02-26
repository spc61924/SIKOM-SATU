<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }

    public function auth(Request $request)
    {
        Session::flash('email', $request->input('email'));

        // VALIDASI DATA YANG MASUK
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email Wajib Diisi',
            'password.required' => 'Password Wajib Diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
            return redirect('data-buku')->with('success', Auth::user()->nama_lengkap .' Berhasil Login');
        } else {
            return redirect('login')->withErrors('Email atau password yang dimasukkan tidak sesuai');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login')->with('success', 'Berhasil Logout');
    }

    function registrasi()
    {
        return view('Auth.registrasi');
    }
    function store(Request $request)
    {
        Session::flash('email', $request->input('email'));

        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'role' => 'required'
        ], [
            'username.required' => 'Username Wajib Diisi',
            'email.required' => 'Email Wajib Diisi',
            'email.email' => 'Email Yang Dimasukkan Tidak Valid',
            'email.unique' => 'Email Sudah Digunakan, Silakan Masukkan Email Yang Lain',
            'password.required' => 'Password Wajib Diisi',
            'password.min' => 'Minumum Password 8 Karakter',
            'nama_lengkap.required' => 'Nama Lengkap Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'role.required' => 'Role Wajib Diisi'
        ]);

        $data = [
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'role' => $request->role
        ];
        User::create($data);
        return redirect('login')->with('success', 'Berhasil registrasi');
    }
}
