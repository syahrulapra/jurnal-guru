<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();

        if(!$user)
            return to_route('login')->with('error', 'Email atau Password tidak sesuai');

        if(!Hash::check($request->input('password'), $user->password))
            return to_route('login')->with('error', 'Email atau Password tidak sesuai');

        if($user->role == 'Admin') {
            Auth::login($user);
            return to_route('admin');
        } elseif($user->role == 'Guru') {
            Auth::login($user);
            return to_route('guru');
        }
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login');
    }
}
