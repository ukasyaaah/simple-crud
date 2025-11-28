<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
        $request->session()->regenerate();
        return redirect()->route('index');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required',
            'email' => 'email|unique:users|string|required',
            'password' => 'string|required|confirmed',
        ]);

        $user = User::create($validated);
        Auth::login($user);
        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login');
    }
}
