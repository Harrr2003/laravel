<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowersListController extends Controller
{
    public function followersList($id)
    {
        $user = Auth::user();
        $my_id = $user->id;
        $followersList = DB::table('requests')->select('*')->where('receiver_id', $id)->where('status',2)->get();
        $senders = [];
        foreach ($followersList as $request) {
            $sender = User::find($request->sender_id);
            if ($sender) {
                $senders[] = $sender;
            }
        }
        return response()->json(['senders' => $senders]);
    }

    public function followingList($id)
    {
        $followingList = DB::table('requests')->select('*')->where('sender_id', $id)->where('status',2)->get();
        $receivers = [];
        foreach ($followingList as $request) {
            $receiver = User::find($request->receiver_id);
            if ($receiver) {
                $receivers[] = $receiver;
            }
        }
        return response()->json($receivers);
    }

    public function followersListforProfile()
    {
        $user = Auth::user();
        $my_id = $user->id;
        $followersList = DB::table('requests')->select('*')->where('receiver_id', $my_id)->where('status',2)->get();
        $senders = [];
        foreach ($followersList as $request) {
            $sender = User::find($request->sender_id);
            if ($sender) {
                $senders[] = $sender;
            }
        }
        return response()->json(['senders' => $senders]);
    }

    public function followingListforProfile()
    {
        $user = Auth::user();
        $my_id = $user->id;
        $followingList = DB::table('requests')->select('*')->where('sender_id', $my_id)->where('status',2)->get();
        $receivers = [];
        foreach ($followingList as $request) {
            $receiver = User::find($request->receiver_id);
            if ($receiver) {
                $receivers[] = $receiver;
            }
        }
        return response()->json($receivers);
    }
}
