<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {

        return view('admin');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(AuthorRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect('/admin');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(AuthorRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }

        return redirect()->route('auth.login');

    }
}
