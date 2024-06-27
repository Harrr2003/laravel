<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{

    public function chats($id)
    {
        $myUser = Auth::user();
        $sender_id = $myUser->id;
        $avatar = $myUser->avatar;
        $receiver_id = $id;
        $chats = Chat::where('sender_id', $sender_id)
            ->where('receiver_id', $receiver_id)
            ->orWhere('sender_id', $receiver_id)
            ->where('receiver_id', $sender_id)
            ->first();
            
        if (!$chats) {
            Chat::create([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id
            ]);
        }
        $user = User::findOrFail($receiver_id);
        $receiverAvatar = $user->avatar;
        return view('chats', compact('user', 'chats', 'sender_id','avatar','receiverAvatar'));
    }

    public function sendMessages(Request $request, $chat_id)
    {
        $user = Auth::user();
        $sender_id = $user->id;
        if ($request->text) {
            Messages::create([
                'sender_id' => $sender_id,
                'chat_id' => $chat_id,
                'text' => $request->text
            ]);
        }

        return redirect()->back();
    }
}
