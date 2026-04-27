<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // proses login user
        if (!Auth::attempt(array_merge($credentials, ['user_type' => 'user']))) {
            return back()->withErrors([
                'username' => 'username atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // ambil nim dari table anggota (tanpa relasi)
        $anggota = DB::table('anggotas')
            ->where('no_anggota', $user->username)
            ->value('nim'); // langsung ambil nim saja (lebih efisien)

        // flag untuk modal
        $forceChangePassword = false;

        if ($anggota) {
            // cek apakah password masih sama dengan nim
            if (Hash::check($anggota, $user->password)) {
                $forceChangePassword = true;
            }
        }

        return redirect()->intended('user/dashboard')
            ->with('force_change_password', $forceChangePassword);
    }

    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(array_merge($credentials, ['user_type' => 'admin']))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'username' => 'username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}