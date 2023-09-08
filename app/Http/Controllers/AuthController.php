<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Hash;
use Session;

class AuthController extends Controller
{
    public function login()
    {
        
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect('posts');
        } else {
            return redirect('login')->with('error_message', 'Email atau Password salah');
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('login');
    }

    public function register_form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            // unique:users artinya membuat email ini unique dari tabel users
            'password'  => 'required|min:8|confirmed'
            // confirmed ini artinya field password sebagai konfirmasi untuk tabel lain yang bernama mirip + _confirmation
            // jadi seperti ini password == password_confirmation
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect('login');
    }
}
