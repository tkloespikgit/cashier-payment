<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Tools;
use App\Admin;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthController extends InitController
{
    //

    public function loginPortal(Request $request)
    {
        if (auth('admin')->check()) {
            return redirect() ->intended('/');
        }

        if ($request ->isMethod('get')) {

            return view('admin.auth.login');
        } else {
            $validator = \Validator::make($request->all(),[
                'account' => 'required',
                'password' => 'required',
                'captcha' => 'captcha|required'
            ]);
            if ($validator ->fails()) {
                self::setMessages($validator ->errors()->all(),'w');
                return redirect()->back()->withInput();

            }
            $maxLoginAttempts = config('auth.maxLoginAttempts',5);
            $lockTime = config('auth.lockTime',20);
            if (\Session::has('AdminUnlockTime') && \Session::get('AdminUnlockTime')>time()) {
                self::setMessages(
                    [trans('auth.throttle',['seconds' =>\Session::get('AdminUnlockTime') - time()])]
                );
                return redirect()->back()->withInput();

            } elseif (\Session::has('AdminUnlockTime') && \Session::get('AdminUnlockTime')<time()) {
                \Session::forget('AdminAttempt');
                \Session::forget('AdminUnlockTime');
            }

            if (\Session::get('AdminAttempt')>$maxLoginAttempts) {
                \Session::put('AdminUnlockTime',time()+$lockTime*60);
                self::setMessages([trans('auth.throttle',['seconds' => $lockTime*60])]);
                return redirect()->back()->withInput();
            }

            try{
                $admin = Admin::where('account',$request->input('account'))->where('status',1)->firstOrFail();
            } catch (ModelNotFoundException $exception) {
                \Session::increment('AdminAttempt',1);
                self::setMessages([trans('auth.failed')],'w');
                return redirect()->back()->withInput();
            }

            if (\Hash::check($request->input('password'),$admin->password)) {
                \Auth::guard('admin')->loginUsingId($admin->id);
                \Session::forget('AdminAttempt');
                \Session::forget('AdminUnlockTime');
                return redirect('/');
            } else {
                \Session::increment('AdminAttempt',1);
                self::setMessages([trans('auth.failed')],'w');
                return redirect()->back()->withInput();
            }
        }
    }

    public function logout()
    {
        \Auth::guard('admin') ->logout();
        return redirect('login');
    }



    public function createAdmin(Request $request)
    {
        if ($request ->isMethod('get')) {

            return view('admin.auth.create');
        } else {
            $validator = $this ->createValidate($request);

            if ($validator['status'] === false) {
                self::setMessages($validator['errors'],'d');
                return redirect() ->back() ->withInput();
            } else {

                $admin = Admin::create([
                    'account' => $request ->input('account'),
                    'password' => bcrypt($request->input('password')),
                    'phone' => $validator['phone'],
                    'email' => $request ->input('email'),
                    'phone_status' => 0,
                    'email_status' => 0,
                    'status' => 1,
                    'phone_country' => strtoupper($request->input('phone_country')),
                    'name' => strtoupper($request->input('account')),
                ]);
                if ($admin ->id > 0) {
                    self::setMessages(['create admin success !'],'s');
                    return redirect() ->back();
                } else {
                    self::setMessages(['create admin failed !'],'d');
                }
            }
        }
        return redirect() ->back() ->withInput();
    }


    public function listAdmin()
    {

    }



    private function createValidate(Request $request)
    {
        $validator =  \Validator::make($request->all(),[
            'captcha' => 'bail|required|captcha',
            'phone_country' => 'bail|required|string|size:2',
            'account' => [
                'required',
                'unique:admin',
                'regex:'.config('regex.account')
            ],
            'email' => 'required|email|unique:admin',
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
                    Admin::where('phone',$phoneNumber) ->firstOrFail();
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
