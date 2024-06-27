<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\PostUrl;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::find(1);

        if (!$user) {
            $this->command->info('User with id 1 not found. Seeder aborted.');
            return;
        }

        
        $posts = Post::factory()->count(10)->create([
            'user_id' => $user->id,
            'title' => $this->generateTitle(),
        ]);

        
        $posts->each(function ($post) {
            $urlsCount = rand(1, 3);
            PostUrl::factory()->count($urlsCount)->create([
                'post_id' => $post->id,
                
            ]);
        });

        $this->command->info('Posts and PostUrls created successfully for user with id 1.');
    }

    /**
     * Generate a random title for the post.
     *
     * @return string
     */
    private function generateTitle()
    {
        $titles = [
            'Amazing Sunset',
            'Beautiful Landscape',
            'City Lights',
            'Mountain Adventure',
            'Ocean Waves',
            'Peaceful Forest',
            'Snowy Peaks',
            'Stunning View',
            'Tranquil Beach',
            'Wildlife Wonders'
        ];

        return $titles[array_rand($titles)];
    }
}
