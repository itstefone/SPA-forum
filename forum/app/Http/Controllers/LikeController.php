<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{


    public function likeIt(Reply $reply, Request $request) {


        $reply->likes()->save(Like::make([
            'user_id' => $request->user()->id
        ]));


        broadcast(new LikeEvent($reply->id,'like', $request->user()->id))->toOthers();


        return response()->json([
            'message' => 'Success liked'
        ], 201);

    }


    public function unlikeIt(Reply $reply, Request $request) {

        optional($reply->likes()->where('user_id', $request->user()->id)->first())->delete();


        broadcast(new LikeEvent($reply->id,'unlike', $request->user()->id))->toOthers();
        return response()->json(null,204);
    }
}
