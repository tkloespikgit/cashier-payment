<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends InitController
{
    //

    public function index(Request $request)
    {
        if ($request ->isMethod('get')) {

            self::setMessages(['Welcome!'],'s');
            return view('admin.index.index');
        }

    }
}
