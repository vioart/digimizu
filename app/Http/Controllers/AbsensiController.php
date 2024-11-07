<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceTokens;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $absensi = new Absensi();
        $absensi->user_id = Auth::id();
        $absensi->tanggal = now()->toDateString();
        $absensi->waktu = now()->toTimeString();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('absensi-fotos', 'public');
            $absensi->foto = $fotoPath;
        }

        $absensi->status = $request->input('status_absen');
        $absensi->keterangan = $request->input('keterangan');
        $absensi->save();

        return redirect()->route('dashboard')->with('success', 'Absensi berhasil dicatat.');
    }
    public function validateToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $token = $request->input('token');

        $attendanceToken = AttendanceTokens::where('token', $token)
            ->where('is_active', 1)
            ->orderBy('tanggal', 'desc')
            ->first();
        
            Log::info('Tanggal dari token: ' . $attendanceToken->tanggal);
            Log::info('Tanggal sekarang (now()): ' . now()->toDateString());
        if ($attendanceToken && $attendanceToken->tanggal->toDateString() === now()->toDateString()) {
            return redirect()->route('absensi')->with('success', 'Token valid! Silakan lakukan absensi.');
        } else {
            return redirect()->back()->with('error', 'Token tidak valid. Silakan coba lagi.');
        }

    }


    public function absensi()
    {
        $user = Auth::user();
        return view('magang.absensi', compact('user'));
    }
}