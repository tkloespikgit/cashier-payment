<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Tools;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends InitController
{
    //


    public function createUser(Request $request)
    {
        if ($request ->isMethod('get')) {

            return view('admin.users.create');
        } else {
            $validator = $this ->createValidate($request);

            if ($validator['status'] === false) {
                self::setMessages($validator['errors'],'d');
                return redirect() ->back() ->withInput();
            } else {

                $user = User::create([
                    'account' => $request ->input('account'),
                    'password' => encrypt($request->input('password')),
                    'phone' => $validator['phone'],
                    'email' => $request ->input('email'),
                    'phone_status' => 0,
                    'email_status' => 0,
                    'status' => 1,
                    'phone_country' => strtoupper($request->input('phone_country')),
                    'name' => strtoupper($request->input('account')),
                ]);
                if ($user ->id > 0) {
                    self::setMessages(['create user success !'],'s');
                    return redirect() ->back();
                } else {
                    self::setMessages(['create user failed !'],'d');
                }
            }
        }
        return redirect() ->back() ->withInput();
    }



    private function createValidate(Request $request)
    {
        $validator =  \Validator::make($request->all(),[
            'captcha' => 'bail|required|captcha',
            'phone_country' => 'bail|required|string|size:2',
            'account' => [
                'required',
                'unique:users',
                'regex:'.config('regex.account')
            ],
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'regex:'.config('regex.password')
            ],
            'phone' => 'required|phone:'.$request->input('phone_country'),
        ]);
        $response = [];
        $response['status'] = false;

        if ($validator ->fails()) {
            $response['errors'] = $validator ->errors()->all();
        } else {
            $phoneNumber = Tools::formatPhone($request->input('phone'),$request->input('phone_country'));
            if ($phoneNumber === false) {
                $response['errors'] = [trans('validation.phone_invalid')];
            } else {
                try{
                    User::where('phone',$phoneNumber) ->firstOrFail();
                    $response['errors'] = [trans('validation.phone_used')];
                } catch (ModelNotFoundException $exception) {
                    $response = [
                        'status' => true,
                        'phone' => $phoneNumber
                    ];
                }
            }
        }
        return $response;
    }

}
