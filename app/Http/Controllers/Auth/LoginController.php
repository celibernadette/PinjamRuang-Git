<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SysUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4'
        ]);

        $credential = ['user_email' => $request->email, 'password' => $request->password];
        $login = Auth::attempt($credential);
        if ($login) {
            // dd(Auth::check());
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->withErrors("Invalid Credential");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $provider = 'google';
            try {
                $googleAccount = Socialite::driver($provider)->user();
            } catch (InvalidStateException $e) {
                $googleAccount = Socialite::driver($provider)->stateless()->user();
            }

            if (!$googleAccount) throw new Exception("Google account not found");

            $dataUser = SysUser::where('user_email', '=', $googleAccount->email)->first();
            if (!$dataUser) throw new Exception("User tidak ditemukan di database");

            Auth::login($dataUser);

            return redirect()->route('home');
        } catch (Exception $e) {
            return redirect()->route('login')->withErrors(['message' => $e->getMessage()]);
        }
    }
}
