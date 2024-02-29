<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
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
                'user_password' => Hash::make($request->input('password'))
            ]);

            return redirect('/login');
        } catch (\Exception $error) {
            return dd($error);
        }
    }

    public function login(Request $request)
    {
        try {
            $user = User::where('username', $request->input('username'))->first();
    
            if ($user && Hash::check($request->input('password'), $user->user_password)) {
                $request->session()->put('user', $user);
    
                switch ($user->role_id){
                    case 1:
                        return redirect('/dashboard_kabeng');
                    case 2:
                        return redirect('/dashboard_departemen');
                    case 3:
                        return redirect('/dashboard_kemenpro');
                    case 4:
                        return redirect('/dashboard_admin');
                    case 5:
                        return redirect('/dashboard_pegawai');
                    case 6:
                        return redirect('/dashboard_user');
                }
            } else {
                return redirect('/login')->with('error', 'Username atau password salah');
            }
        } catch (\Exception $error) {
            return redirect('/login')->with('error', 'Terjadi kesalahan: ' . $error->getMessage());
        }
    }
    
}
