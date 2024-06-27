<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function like($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $like = Like::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if ($like) {
            $like->delete();
            $action = 'unliked';
        } else {
            $like = Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id,
            ]);
            $action = 'liked';
        }
        return response()->json([$action, $post_id]);
    }
}
