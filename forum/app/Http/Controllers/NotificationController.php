<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{


    public function __construct()
    {
            $this->middleware(['auth:api']);
    }


    public function index(Request $request) {

        return response()->json([
            'read' => $request->user()->readNotifications,
            'unread' => $request->user()->unreadNotifications
        ],200);

    }


    public function markAsRead(Request $request) {
            $request->user()->notifications->where('id', $request->id)->first()->markAsRead();

            return response()->json(['message'=>'Read successfully'],200);
    }
}
