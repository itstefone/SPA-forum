<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Models\Question;
use App\Models\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
{


    public function index(Question $question) {
        $replies  = $question->replies()->paginate(5);


        return ReplyResource::collection($replies);
    }


    public function show(Question $question, Reply $reply ) {
        return new ReplyResource($reply);
    }

    public function store(Question $question, Request $request) {

        $reply =  $question->replies()->save($reply = Reply::make([
            'user_id' => $request->user()->id,
            'body' => $request->body
        ]));


        $reply->question->user->notify(new NewReplyNotification($reply));


        return response()->json([
            'reply' => new ReplyResource($reply),
        ], 201);
    }


    public function update(Question $question, Reply $reply, Request $request) {

        $reply->body = $request->body;
        $reply->save();

        return response()->json([
            'message' => 'Success update',
            'reply' => new ReplyResource($reply)
        ], 202);
    }


    public function destroy(Question $question, Reply $reply, Request $request) {
        $reply->delete();
        return response()->json(null, 204);
    }
}
