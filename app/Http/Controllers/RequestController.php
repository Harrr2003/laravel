<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\requestLike;
use App\Models\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{
    public function request($id)
    {
        $user = Auth::user();
        $sender_id = $user->id;
        $sender_id = auth()->user()->id;
        $receiver_id = $id;
        $thereIsRequest = Requests::where('sender_id', $sender_id)
            ->where('receiver_id', $receiver_id)
            ->first();
        if (!$thereIsRequest) {
            $thereIsRequest = Requests::create([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
            ]);
        } elseif ($thereIsRequest->status !== 0) {
            $thereIsRequest->delete();
        }
        return redirect()->back();
    }

    public function confirm($id)
    {
        $user = Auth::user();
        $my_id = $user->id;
        $request = Requests::find($id);
        $request->status = 2;
        $request->save();

        return redirect()->back();
    }

    public function delete($id)
    {
        $request = Requests::find($id);
        $request->delete();
        return redirect()->back();
    }
    public function index()
    {
        $requests = Requests::with('sender')->where('status', 1)->get();
        $requestsCount = DB::table('requests')
            ->where('status', 1)
            ->count();
        $requestIds = Requests::pluck('receiver_id')->toArray();
        $my_id = Auth::id();
        Requests::where('receiver_id', $my_id)
            ->where('status', 1)
            ->update(['is_viewed' => 1]);
        requestLike::where('receiver_id', $my_id)
            ->where('status', 0)
            ->update(['is_viewed' => 1]);
        $filterRequestIds = array_filter($requestIds, function ($id) use ($my_id) {
            return $id == $my_id;
        });
        $requestLike = DB::table('request_like')->select('name', 'avatar')->where('');
        if (empty($filterRequestIds)) {
            return response()->json([]);
        }
        return response()->json([
            'requests' => $requests,
            'requestsCount' => $requestsCount,
            'my_id' => $my_id
        ]);
    }
}
