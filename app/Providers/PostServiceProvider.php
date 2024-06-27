<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\DB;

class PostServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['profile'], function ($view) {
            if (auth()->check()) {
                $user = auth()->user();
                $posts = $user->posts()->with('postUrl')->get();
                $view->with('posts', $posts);
            } else {
                $view->with('posts', collect());
            }
        });
        view()->composer(['posts', 'myPosts'], function ($view) {
            $posts = Post::with('postUrl')->get();
            $postIds = $posts->pluck('id')->toArray();
            $postLikeCounts = [];
            foreach ($postIds as $postId) {
                $likeCount = DB::table('likes')->where('post_id', $postId)->count();
                $postLikeCounts[$postId] = $likeCount;
            }
            $view->with([
                'posts' => $posts,
                'postIds' => $postIds,
                'postLikeCounts' => $postLikeCounts,
            ]);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
