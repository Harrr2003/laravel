<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $my_id = $user->id;
        $followersCount = DB::table('requests')->select('*')->where('receiver_id', $my_id)->where('status', 2)->count();
        $followingCount = DB::table('requests')->select('*')->where('sender_id', $my_id)->where('status', 2)->count();
        $postsCount = DB::table('posts')->select('*')->where('user_id', $my_id)->count();
        $posts = DB::table('posts')->select('id')->where('user_id', $my_id)->get();
        $postsImages = [];
        foreach ($posts as $post) {
            $postImages = DB::table('post_urls')->select('*')->where('post_id', $post->id)->get();
            $postsImages[] = $postImages;
        }
        return view('profile', compact('followersCount', 'followingCount', 'postsCount', 'postsImages'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'password.confirmed' => 'The new password confirmation does not match.',
        ]);

        /** @var user */
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        if (method_exists($user, 'save')) {
            if ($user->save()) {
                $request->session()->put('user', $user);
                return redirect()->route('profile')->with('success', 'Profile updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update profile.');
            }
        }
    }
}
