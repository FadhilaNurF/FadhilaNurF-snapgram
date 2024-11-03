<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //menampilkan halaman login
    public function showLoginForm() {
        return view('auth.login');
    }

    public function postLogin(Request $request){
        $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)){
            return redirect()->route('home');
        }

        return back();

    }

    public function showRegistrationForm() {
        //tampilin halaman regis
        return view('auth.register');
    }

    public function register(Request $request){
        //handle regis
        $request->validate([
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);
        //membuat pengguna baru
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        //mengalihkan ke login setelah regis
        return redirect()->route('login');
    }

    public function logout(Request $request) {
        //handle logout
        Auth::logout();
        return redirect()->route('login');
    }
}


