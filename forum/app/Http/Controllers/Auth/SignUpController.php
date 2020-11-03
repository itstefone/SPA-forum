<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;

class SignUpController extends Controller
{



    public function __invoke(UserRegisterRequest $request) {


        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Success created!'
        ], 201);

    }
}
