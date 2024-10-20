<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $absensi = new Absensi();
        $absensi->user_id = Auth::id();  // Menggunakan Auth::id() untuk mendapatkan ID pengguna
        $absensi->tanggal = now()->toDateString();
        $absensi->waktu = now()->toTimeString();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('absensi-fotos', 'public');
            $absensi->foto = $fotoPath;
        }

        $absensi->save();

        return redirect()->route('dashboard')->with('success', 'Absensi berhasil dicatat.');
    }
}