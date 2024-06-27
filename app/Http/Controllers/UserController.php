<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function search(Request $request)
    {
        $user = Auth::user();
        $my_id = $user->id;
        $text = $request->input('text');

        if (!empty($text)) {
            $users = DB::table('users')
                ->select('id', 'avatar', 'name')
                ->where('name', 'like', '%' . $text . '%')
                ->where('status', 0)
                ->distinct()
                ->get();
            $users_id = [];
            foreach ($users as $user) {
                $users_id[] = $user->id;
            }
            $follow = DB::table('requests')
                ->select('*')
                ->where('sender_id', $my_id)
                ->where('receiver_id', $users_id)
                ->get();

            return response()->json(['users' => $users, 'follow' => $follow, 'my_id' => $my_id]);
        }

        return response()->json([]);
    }

    public function showUserProfile($id)
    {
        $user = Auth::user();
        $my_id = $user->id;
        $user_get = User::findOrFail($id);

        if ($my_id == $id) {
            return redirect()->route('profile');
        } else {
            session(['user' => $user]);
            $follow = DB::table('requests')->select('*')->where('sender_id', $my_id)->where('receiver_id', $id)->first();
            $followersCount = DB::table('requests')->select('*')->where('receiver_id', $id)->where('status', 2)->count();
            $followingCount = DB::table('requests')->select('*')->where('sender_id', $id)->where('status', 2)->count();
            $postsCount = DB::table('posts')->select('*')->where('user_id', $id)->count();

            return view('userProfile', compact('user_get', 'user', 'follow', 'followersCount', 'followingCount', 'postsCount', 'my_id', 'id'));
        }
    }

    public function followersAndFollowing()
    {
    }
}
