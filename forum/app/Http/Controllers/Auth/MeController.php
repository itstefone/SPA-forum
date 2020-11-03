<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class MeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api']);
    }


    public function __invoke(Request $request)
    {

        return response()->json([
            'user' => new UserResource($request->user())
        ],200);

    }
}
