<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{


    public function __invoke(Request $request)
    {

        if(!$token = Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json([
                'message' => 'Email or password was inccorect!'
            ],409);
        }


        return response()->json([
            'message' => 'Success signin',
            'type' => 'Bearer',
            'token' => $token
        ], 200);
    }
}
