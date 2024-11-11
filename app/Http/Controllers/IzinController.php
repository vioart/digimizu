<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use Illuminate\Support\Facades\Auth;
use App\Models\AttendanceTokens;
use Carbon\Carbon;

class IzinController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:300',
            'dari_tanggal' => 'required|date',
            'sampai_tanggal' => 'required|date|after_or_equal:dari_tanggal',
        ]);

        $startDate = Carbon::parse($request->input('dari_tanggal'));
        $endDate = Carbon::parse($request->input('sampai_tanggal'));
        $status = $request->input('status_absen');
        $keterangan = $request->input('keterangan');

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('absensi-fotos', 'public');
        }

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $izin = new Izin();
            $izin->user_id = Auth::id();
            $izin->tanggal = $date->toDateString();
            $izin->waktu = now()->toTimeString();
            $izin->foto = $fotoPath;
            $izin->status = $status;
            $izin->keterangan = $keterangan;
            $izin->save();
        }

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
        
        if ($attendanceToken && $attendanceToken->tanggal->toDateString() === now()->toDateString()) {
            return redirect()->route('izin')->with('success', 'Token valid! Silakan lakukan absensi.');
        } else {
            return redirect()->back()->with('error', 'Token tidak valid. Silakan coba lagi.');
        }

    }

    public function izin()
    {
        $user = Auth::user();
        return view('magang.izin', compact('user'));
    }
}
