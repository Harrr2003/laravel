<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $my_id = $user->id;
            session(['user' => $user]);
            return redirect()->route('index');
        } else {
            return back()->withInput()->withErrors(['password' => 'Invalid credentials']);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
