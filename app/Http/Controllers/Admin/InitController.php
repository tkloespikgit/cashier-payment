<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InitController extends Controller
{

    //
    private static $messageType = [
        'w' => 'warning',
        's' => 'success',
        'd' => 'danger',
    ];

    protected static function currentGuard()
    {
        return auth()->guard('admin');
    }

    //
    protected static function currentUser()
    {
        if (auth('admin')->check())
            return auth('admin')->user();
        else
            return null;
    }

    protected static function setMessages(array $messages,$type = 'w')
    {

        \Session::flash('Messages',json_encode($messages));
        \Session::flash('Message_type',self::$messageType[$type]);
        return true;
    }



    protected static function ajaxReturn($message = 'Errors ,please try again',$status = 0)
    {
        return response() ->json([
            'status' => $status,
            'message' => $message
        ]);

    }

}
