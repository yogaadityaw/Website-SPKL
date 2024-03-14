<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'nip' => 'required',
            'fullname' => 'required',
            'telephone' => 'required',
            'age' => 'required',
            'password' => 'required|min:6'
        ]);
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'user_nip' => $request->input('nip'),
                'user_fullname' => $request->input('fullname'),
                'user_telephone' => $request->input('telephone'),
                'user_age' => $request->input('age'),
                'role_id' => 6,
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect('/login');
        } catch (\Exception $error) {
            return dd($error);
        }
    }

    public function login(Request $request)
    {
        try {
            $attributes = $request->validate([
                'username' => 'required',
                'password' => 'required|min:6'
            ]);


            if (Auth::attempt($attributes)) {
                switch (auth()->user()->role_id) {
                    case 1:
                        return redirect('/dashboard-bengkel');
                    case 2:
                        return redirect('/dashboard-departemen');
                    case 3:
                        return redirect('/dashboard-kemenpro');
                    case 4:
                        return redirect('/dashboard-admin');
                    case 5:
                        return redirect('/dashboard-pegawai');
                    case 6:
                        return redirect('/dashboard-user')->with('user', auth()->user());
                }
            } else {
                return redirect('/login')->with('error', 'Username atau password salah');
            }
        } catch (\Exception $error) {
            return redirect('/login')->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
