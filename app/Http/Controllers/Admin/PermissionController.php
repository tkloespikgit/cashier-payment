<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends InitController
{
    //

    public function listPermission(Request $request)
    {
        $permissions = Permission::paginate(15);
        if ($request ->isMethod('get')) {
            return view('admin.auth.permissions',compact('permissions'));
        } else {
            $validator = \Validator::make($request ->all(),[
                'key' => 'required|alpha_dash|max:20|unique:permissions,name',
                'display_name' => 'required|max:30',
                'description' => 'required|max:200',
                'captcha' => 'required|captcha'
            ]);

            if ($validator ->fails()) {
                self::setMessages($validator->errors()->all(),'d');
                return redirect() ->back() ->withInput();
            } else {

                $permission = Permission::create([
                    'name' => $request ->input('key'),
                    'display_name' => $request ->input('display_name'),
                    'description' => $request ->input('description')
                ]);
                self::setMessages(['create permission ('.$permission ->display_name.') success !'],'s');
                return redirect() ->back() ->with('new_id',$permission ->id);

            }

        }
    }

    public function editPermission(Request $request,$id)
    {
        $permission = Permission::find($id);
        if ($request ->isMethod('get')) {
            return view('admin.frame.edit-permission',compact('permission'));
        } else {

            $validator = \Validator::make($request ->all(),[
                'key' => 'required|alpha_dash|max:20',
                'display_name' => 'required|max:30',
                'description' => 'required|max:200',
                'captcha' => 'required|captcha'
            ]);
            if ($validator ->fails()) {
                return self::ajaxReturn($validator ->errors() ->first());
            } else {
                $count = \DB::table('permissions')
                    ->where('name',$request ->input('key'))
                    ->where('id','!=',$permission->id)
                    ->count();
                if ($count > 0) {
                    return self::ajaxReturn("The key(name) field is occupied !");
                } else {
                    $permission ->update([
                        'name' => $request ->input('key'),
                        'display_name' => $request ->input('display_name'),
                        'description' => $request ->input('description')
                    ]);

                    $permission ->save();
                    return self::ajaxReturn("Update permission success !",1);
                }
            }
        }
    }
}
