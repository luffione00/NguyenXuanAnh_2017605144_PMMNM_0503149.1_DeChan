<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register(Request $request): \Illuminate\Http\RedirectResponse
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'email'=> ['required','email'],
            'password' => ['required'],
        ]);
        $user = User::create($credentials);
        auth()->login($user);

        return redirect()->to('/');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
