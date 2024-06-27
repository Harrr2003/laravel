<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordResetController extends Controller
{
    public function showResetForm(){
        return view('email-reset');
    }
    public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    $response = Password::sendResetLink(
        $request->only('email')
    );

    return $response == Password::RESET_LINK_SENT
    ? redirect()->route('password-reset')
    : back();
}
}
