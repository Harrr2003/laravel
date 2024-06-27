<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function showAddPosts()
    {
        return view('add-posts');
    }

    public function addPost(Request $request)
{
    $user = Auth::user();
    $my_id = $user->id;

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'files.*' => 'nullable|file|max:20480|mimetypes:image/jpeg,image/png,image/gif,video/mp4,video/avi,video/mpeg',
    ]);

    if ($request->hasFile('files')) {
        $post = new Post([
            'user_id' => $my_id,
            'title' => $request->input('title'),
        ]);
        $post->save();

        foreach ($request->file('files') as $file) {
            $fileName = $file->hashName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $postUrl = new PostUrl([
                'post_id' => $post->id,
                'url' => $fileName
            ]);
            $postUrl->save();
        }

        return redirect()->route('profile')->with('success', 'Post added successfully!');
    } else {
        return redirect()->route('add-post')->with('error', 'No files uploaded.');
    }
}

}
