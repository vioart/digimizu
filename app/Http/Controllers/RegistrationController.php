<?php

namespace App\Http\Controllers;

use App\Models\CalonMagang;
use App\Models\SoalTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Log::info('Registration process started', $request->except('password', 'password_confirmation'));

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:calon_magang,email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'asal_instansi' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $imagePath = $request->file('image')->store('profile-images', 'public');

            $calonMagang = CalonMagang::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'asal_instansi' => $validatedData['asal_instansi'],
                'image' => $imagePath,
            ]);

            DB::commit();

            Log::info('CalonMagang created', ['id' => $calonMagang->id, 'email' => $calonMagang->email]);

            return redirect()->route('registration.test', ['id' => $calonMagang->id])
                             ->with('success', 'Pendaftaran berhasil. Silakan lanjutkan dengan tes.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error during registration', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.']);
        }
    }

    public function showTestForm($id)
    {
        $calonMagang = CalonMagang::findOrFail($id);
        
        if ($calonMagang->test_score !== null) {
            Log::info('Attempt to access test form for completed test', ['id' => $id]);
            return redirect()->route('registration.complete', ['id' => $id])
                             ->with('info', 'Anda sudah menyelesaikan tes.');
        }

        $soalTest = SoalTest::inRandomOrder()->limit(10)->get();
        return view('auth.test', compact('soalTest', 'id', 'calonMagang'));
    }

    public function submitTest(Request $request, $id)
    {
        Log::info('Test submission started', ['id' => $id]);

        $calonMagang = CalonMagang::findOrFail($id);
        
        if ($calonMagang->test_score !== null) {
            Log::info('Attempt to submit test for completed test', ['id' => $id]);
            return redirect()->route('registration.complete', ['id' => $id])
                             ->with('info', 'Anda sudah menyelesaikan tes.');
        }

        $answers = $request->input('answers');
        $score = 0;

        foreach ($answers as $soalId => $jawaban) {
            $soal = SoalTest::findOrFail($soalId);
            if ($soal->jawaban_benar === $jawaban) {
                $score++;
            }
        }

        $calonMagang->update([
            'test_score' => $score,
            'test_date' => now(),
        ]);

        Log::info('Test submitted', ['id' => $id, 'score' => $score]);

        return redirect()->route('registration.complete', ['id' => $id]);
    }

    public function showCompletionPage($id)
    {
        $calonMagang = CalonMagang::findOrFail($id);
        Log::info('Showing completion page', ['id' => $id, 'score' => $calonMagang->test_score]);
        return view('auth.registration-complete', compact('calonMagang'));
    }
}