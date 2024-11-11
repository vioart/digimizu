<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Izin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class MagangController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $startDate = $user->created_at;
        $dayCount = intval($startDate->diffInDays(Carbon::now()) + 1);
        
        if ($dayCount < 1) {
            $dayCount = 1;
        }

        $presentCount = Absensi::where('user_id', $user->id)
                            ->where('status', 'absen')
                            ->count();
        $permissionCount = Absensi::where('user_id', $user->id)
                            ->where('status', 'izin')
                            ->count();;
        $absentCount = max(0, $dayCount - $presentCount - $permissionCount);
        $todayAttendance = Absensi::where('user_id', $user->id)
                            ->whereDate('tanggal', Carbon::today())
                            ->first();
        $todayPermission = Absensi::where('user_id', $user->id)
                            ->whereDate('tanggal', Carbon::today())
                            ->first();

        return view('magang.dashboard', compact('dayCount', 'presentCount', 'absentCount', 'permissionCount', 'todayAttendance', 'todayPermission'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('magang.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $updateData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile-images', 'public');
            $updateData['image'] = $imagePath;
        }

        User::where('id', $user->id)->update($updateData);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function izin()
    {
        return view('magang.izin');
    }

    public function storeIzin(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
            'bukti' => 'required|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        $izin = new Izin();
        $izin->user_id = Auth::id();
        $izin->tanggal = $validatedData['tanggal'];
        $izin->alasan = $validatedData['alasan'];
        $izin->status = 'pending';

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('izin-bukti', 'public');
            $izin->bukti = $buktiPath;
        }

        try {
            if ($izin->save()) {
                Log::info('Izin berhasil disimpan', ['user_id' => Auth::id(), 'tanggal' => $izin->tanggal]);
                return redirect()->route('dashboard')->with('success', 'Izin berhasil diajukan.');
            } else {
                Log::error('Gagal menyimpan izin', ['user_id' => Auth::id(), 'tanggal' => $izin->tanggal]);
                return redirect()->back()->with('error', 'Gagal mengajukan izin. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan izin', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function listIzin()
    {
        $user = Auth::user();
        $izinList = Izin::where('user_id', $user->id)->orderBy('tanggal', 'desc')->get();
        return view('magang.list-izin', compact('izinList'));
    }
}