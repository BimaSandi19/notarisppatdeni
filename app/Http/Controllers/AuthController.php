<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    /* ==========================
       LOGIN & LOGOUT
    ========================== */
    public function showLoginForm()
    {
        $response = response()->view('auth.login');
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
        return $response;
    }

    public function login_proses(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Proteksi brute force - cek failed login attempts
        $username = $data['username'];
        $key = 'login_attempts_' . md5($username . $request->ip());
        $attempts = cache()->get($key, 0);

        // Jika sudah 5x gagal dalam 15 menit, block
        if ($attempts >= 5) {
            return redirect()->route('login')->with('failed', 'Terlalu banyak percobaan login. Coba lagi dalam 15 menit.');
        }

        if (Auth::attempt(['username' => $data['username'], 'password' => $data['password']])) {
            // Reset failed attempts jika berhasil
            cache()->forget($key);

            $request->session()->regenerate();

            // Update last login timestamp
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                \App\Models\User::where('id', $user->getAuthIdentifier())
                    ->update(['terakhir_login' => now()]);
            }

            return redirect()->route('admin.dashboard');
        }

        // Increment failed attempts (expired dalam 15 menit)
        cache()->put($key, $attempts + 1, now()->addMinutes(15));

        return redirect()->route('login')->with('failed', 'Username atau Password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /* ==========================
       LUPA KATA SANDI
    ========================== */

    // 1️⃣ Tampilkan form lupa password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // 2️⃣ Kirim link reset password
    public function sendResetLink(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);

        $status = Password::sendResetLink($credentials);

        // Selalu tampilkan pesan sukses (jangan kasih tahu email exist atau tidak - security best practice)
        return back()->with('status', 'Kami telah mengirimkan link reset password ke email Anda (jika email terdaftar).');
    }

    // 3️⃣ Tampilkan form reset password dari link email
    public function showResetForm(string $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    // 4️⃣ Update password ke database
    public function updatePassword(Request $request)
    {
        // Validasi input
        try {
            $data = $request->validate([
                'token'    => 'required',
                'email'    => 'required|email:rfc,dns',
                'password' => ['required', 'confirmed', Rules\Password::min(8)],
            ], [
                'password.confirmed' => 'Konfirmasi password tidak cocok dengan password baru.',
                'password.min' => 'Password minimal harus 8 karakter.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->errors())
                ->withInput($request->except('password', 'password_confirmation'));
        }

        $status = Password::reset(
            $data,
            function ($user) use ($data) {
                $user->forceFill([
                    'password' => Hash::make($data['password']),
                ])->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Kata sandi berhasil direset. Silakan login.');
        }

        return back()->with('failed', 'Token tidak valid atau sudah kadaluarsa.');
    }
}
