<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{

    public function index() {
        $questions = Question::latest()->paginate(20);
        return QuestionResource::collection($questions);
    }

    public function show(Question $question) {


        return new QuestionResource($question);

    }




    public function update(Question $question, Request $request) {


       $question->update([
            'title' => $title = $request->title,
            'slug' => Str::slug($title),
            'body' => $request->body,
            'category_id' => $request->category_id
        ]);




        return response()->json([
            'question' => new QuestionResource($question),
            'message' => 'Success update!'
        ], 202);
    }

    public function store(Request $request) {

       $question =   Question::create([
            'title' => $title = $request->title,
            'slug' => Str::slug($title),
            'body' => $request->body,
            'user_id' => $request->user()->id,
            'category_id' => $request->category
        ]);


        return response()->json([
            'message' => 'Success created!',
            'question' => new QuestionResource($question)
        ], 201);
    }
    public function destroy(Question $question) {
        $question->delete();

        return response()->json([
            'message' => 'Success deleted!'
        ], 204);
    }
}
