<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }
    public function postlogin(Request $request)
    {
        $validasi = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validasi)) {
            $request->session()->regenerate();
            DB::table('users_logs')->insert([
                'user_id' => Auth::user()->id,
                'tanggal' => now(),
                'ngapain' => 'LOGIN SISTEM',
                'ipnya' => $request->getClientIp(),
            ]);
            return redirect()->intended('dashboard')->with('sukses', 'Anda Berhasil Masuk Kesistem');
        }
        return back()->withErrors([
            'username' => 'Username Tidak Terdaftar'
        ]);
    }
    public function logout(Request $request)
    {
        DB::table('users_logs')->insert([
            'user_id' => Auth::user()->id,
            'tanggal' => now(),
            'ngapain' => 'LOGOUT SISTEM',
            'ipnya' => $request->getClientIp(),
        ]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('sukses', 'Anda Berhasil Keluar Dari Sistem');
    }

    public function cekusername(Request $request)
    {
        $countUsername = User::where('username', $request->username)->count();
        if ($countUsername >= 1) {
            return response()->json(['success' => 'Username Anda Benar']);
        } else {
            return response()->json(['error' => 'Maaf Username not found!']);
        }
    }
    public function cekpassword(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $countUsername = User::where('username', $request->username)->count();
        if ($countUsername >= 1) {
            if (Hash::check($request->password, $user->password)) {
                return response()->json(['success' => 'Password Anda Benar']);
            } else {
                return response()->json(['error' => 'Maaf Username not found!']);
            }
        } else {
            return response()->json(['warning' => 'Maaf Username not found!']);
        }
    }
}
