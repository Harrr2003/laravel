<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserPostsController extends Controller
{
    public function userPosts($id)
    {
        $userPosts = Post::where('user_id', $id)->get();
        $allPosts = [];

        foreach ($userPosts as $userPost) {
            $postUrls = PostUrl::where('post_id', $userPost->id)->get();
            $allPosts = array_merge($allPosts, $postUrls->toArray());
        }

        return view('posts', compact('allPosts'));
    }
    public function myPosts()
    {
        $user_id = Auth::user()->id;
        $allPosts = Post::where('user_id', $user_id)->get();
        return view('myPosts', compact('allPosts'));
    }
    public function deletePost($post_id)
    {
        DB::table('posts')->where('id', $post_id)->delete();

        return redirect()->back();
    }

}
