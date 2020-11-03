<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignOutController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth:api']);
    }


    public function __invoke(Request $request)
    {

        Auth::logout();


        return response()->json([
            'message' => 'Success signout'
        ],202);

    }

}
