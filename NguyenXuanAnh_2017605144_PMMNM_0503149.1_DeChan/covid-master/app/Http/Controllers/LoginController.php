<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function register(Request $request): RedirectResponse
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

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'name'=> ['required'],
            'password' => ['required'],
        ]);

        if (auth()->attempt($credentials))
        {
            return redirect()->to('/');
        };

        return back()->withErrors([
                'message' => 'Tên hoặc mật khẩu không chính xác, vui lòng thử lại sau.'
            ]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()->to('/');
    }
}
