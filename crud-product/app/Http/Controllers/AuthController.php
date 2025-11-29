<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreLoginRequest;
use App\Http\Requests\Auth\StoreRegisterRequest;
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

    public function login(StoreLoginRequest $request)
    {
        $credentials = $request->validated();


        if (!Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
        }
        $request->session()->regenerate();
        return redirect()->route('index');
    }

    public function register(StoreRegisterRequest $request)
    {
        $user = User::create($request->validated());
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
