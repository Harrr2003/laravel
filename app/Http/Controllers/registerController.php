<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class registerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function add(Request $req)
    {
        $req->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            'gender' => 'required|in:Male,Female',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Invalid gender.',
        ]);
        $imageName = ($req->gender === 'Male') ? 'male.png' : 'female.png';
        $data['avatar'] = 'images/' . $imageName;
        $data['name'] = $req->name;
        $data['email'] = $req->email;
        $data['password'] = Hash::make($req->password);
        $data['gender'] = $req->gender;
        $data['password_reset_token'] = Str::random(60);
        $user = User::create($data);
        if ($user) {
            return redirect()->route('login.form');
        }
    }
}
