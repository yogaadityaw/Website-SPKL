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
        // $this->validate($request, [
        //     'username' => 'required|max:255',
        //     'nip' => 'required|numeric|max:255',
        //     'fullname' => 'required|max:255',
        //     'email' => 'required|email|max:255',
        //     'telephone' => 'required|numeric|max:255',
        //     'age' => 'required|numeric|max:255',
        //     'password' => 'required|min:6'
        // ]);
        try {
            // ketika pertama kali melakukan register maka user mendapatkan role ke 6 yaitu sebagai user biasa untuk menunggu konfirmasi dari admin
            $user = User::create([
                'username' => $request->input('username'),
                'user_nip' => $request->input('nip'),
                'user_fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'user_telephone' => $request->input('telephone'),
                'user_age' => $request->input('age'),
                'role_id' => 6,
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect('/')->with('success', 'Akun berhasil dibuat, silahkan login');
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
                        return redirect()->route('dashboard-admin');
                    case 2:
                        return redirect()->route('dashboard-kabeng');
                    case 3:
                        return redirect()->route('dashboard-departemen');
                    case 4:
                        return redirect()->route('dashboard-kemenpro');
                    case 5:
                        return redirect()->route('list-spkl-pegawai');
                    case 6:
                        return redirect()->route('dashboard-user')->with('user', auth()->user());
                }
            } else {
                return redirect('/')->with('error', 'Username atau password salah');
            }
        } catch (\Exception $error) {
            return redirect('/')->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
}
