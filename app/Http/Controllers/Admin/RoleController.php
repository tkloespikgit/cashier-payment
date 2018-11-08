<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends InitController
{
    //

    public function rolesList(Request $request)
    {
        if ($request ->isMethod('get')) {
            $roles = Role::paginate(15);
            $permissions = Permission::all();
            return view('admin.auth.roles',compact('roles','permissions'));
        } else {
            $validator = \Validator::make($request ->all(),[
                'key' => 'required|alpha_dash|max:20|unique:roles,name',
                'display_name' => 'required|max:30',
                'description' => 'required|max:200',
                'captcha' => 'required|captcha'
            ]);

            if ($validator ->fails()) {
                self::setMessages($validator->errors()->all(),'d');
                return redirect() ->back() ->withInput();
            } else {
                $role = Role::create([
                    'name' => $request ->input('key'),
                    'display_name' => $request ->input('display_name'),
                    'description' => $request ->input('description')
                ]);
                if (count($request->input('permissions'))>0) {
                    $role ->perms() ->sync($request ->input(['permissions']));
                }
                self::setMessages(['create role ('.$role ->display_name.') success !'],'s');
                return redirect() ->back() ->with('new_id',$role ->id);
            }
        }
    }

    public function editRole(Request $request,$id)
    {
        $role = Role::find($id);
        if ($request ->isMethod('get')) {
            $permissions = Permission::all();

            return view('admin.frame.edit-role',compact('role','permissions'));
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
                $count = \DB::table('roles')
                    ->where('name',$request ->input('key'))
                    ->where('id','!=',$role->id)
                    ->count();
                if ($count > 0) {
                    return self::ajaxReturn("The key(name) field is occupied !");
                } else {
                    $role ->update([
                        'name' => $request ->input('key'),
                        'display_name' => $request ->input('display_name'),
                        'description' => $request ->input('description')
                    ]);

                    $role ->save();

                    if (count($request->input('permissions'))>0) {
                        $role ->perms() ->sync($request ->input(['permissions']));
                    } else {
                        $role ->perms() ->sync([]);
                    }

                    return self::ajaxReturn("Update permission success !",1);
                }
            }



        }

    }
}
