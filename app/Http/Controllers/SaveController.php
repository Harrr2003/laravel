<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    public function save($post_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $save = Save::where('post_id', $post_id)->where('user_id', $user_id)->first();
        if ($save) {
            $save->delete();
            $action = 'unSaved';
        } else {
            $save = Save::create([
                'user_id' => $user_id,
                'post_id' => $post_id
            ]);
            $action = 'saved';
        }
        return response()->json(['action' => $action, 'post_id' => $post_id]);
    }
}
