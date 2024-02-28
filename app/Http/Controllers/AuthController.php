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
                return redirect('/dashboard');
            } else {
                return redirect('/login');
            }
        } catch (\Exception $error) {
            return dd($error);
        }
    }
}
