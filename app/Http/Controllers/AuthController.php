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
            // $user = User::where('username', $request->input('username'))->first();

            // if ($user && Hash::check($request->input('password'), $user->user_password)) {
            //     $request->session()->put('user', $user);

            //     switch ($user->role_id) {
            //         case 1:
            //             return redirect('/dashboard_bengkel');
            //         case 2:
            //             return redirect('/dashboard_departemen');
            //         case 3:
            //             return redirect('/dashboard_kemenpro');
            //         case 4:
            //             return redirect('/dashboard_admin'); 
            //         case 5:
            //             return redirect('/dashboard_pegawai');
            //         case 6:
            //             return redirect('/dashboard_user');
            //     }
            $attributes = $request->validate([
                'username' => 'required',
                'password' => 'required|min:6'
            ]);


            if (Auth::attempt($attributes)) {
                switch (auth()->user()->role_id) {
                    case 1:
                        return redirect('/dashboard_bengkel');
                    case 2:
                        return redirect('/dashboard_departemen');
                    case 3:
                        return redirect('/dashboard_kemenpro');
                    case 4:
                        return redirect('/dashboard_admin');
                    case 5:
                        return redirect('/dashboard_pegawai');
                    case 6:
                        return redirect('/dashboard_user')->with('user', auth()->user());
                }
            } else {
                return redirect('/login')->with('error', 'Username atau password salah');
            }
        } catch (\Exception $error) {
            return redirect('/login')->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();
        dd("Logout bos");
        // return redirect('/login');
    }
}
