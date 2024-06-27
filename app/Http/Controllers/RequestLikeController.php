<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\PostUrl;
use App\Models\requestLike;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RequestLikeController extends Controller
{
    public function reqLike($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $receiver = DB::table('posts')->where('id', $post_id)->first();
        $receiver_id = $receiver->user_id;
        $like = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if ($like && $user_id !== $receiver_id) {
            $reqLikes = requestLike::create([
                'sender_id' => $user_id,
                'receiver_id' => $receiver_id,
                'post_id' => $post_id,
            ]);
        } else {
            $reqLikes = requestLike::where('sender_id', $user_id)
                ->where('receiver_id', $receiver_id)
                ->where('post_id', $post_id)
                ->first();
            if ($reqLikes) {
                $reqLikes->delete();
            }
        }
    }
    public function reqLikeRes()
    {
        $user = Auth::user();
        $user_id = $user->id;


        $request_likes = DB::table('request_likes')->where('receiver_id', $user_id)->get();

        $requests = [];
        foreach ($request_likes as $like) {
            $sender = User::find($like->sender_id);
            $post = PostUrl::find($like->post_id);
            $time = $like->created_at;
            $timeAgo = Carbon::parse($time)->diffForHumans();
            if ($sender && $post) {
                $requests[] = [
                    'sender' => $sender,
                    'url' => asset('storage/uploads/' . $post->url)
                ];
            }
        }

        return response()->json(['requests' => $requests, 'time' => $timeAgo]);
    }
}
