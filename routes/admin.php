<?php


// auth portal

Route::any('login',"AuthController@loginPortal");
Route::any('logout',"AuthController@logout");

Route::group(['middleware'=> 'adminGuard'],function (){


//index
    Route::get('/',"IndexController@index")->name('dashboard');
    Route::get('/dashboard',"IndexController@index");

//user control
    Route::any('user/create',"UserController@createUser");
    Route::any('user/list',"UserController@createUser");

//admin control
    Route::any('admins/list',"AuthController@createAdmin");
    Route::any('admins/modify/{action}/{id}',"AuthController@updateAdmin");
    Route::any('self/setting',"AuthController@selfSetting");


    Route::any('permissions/list',"PermissionController@listPermission");
    Route::any('permissions/edit/{id}',"PermissionController@editPermission");

    Route::any('roles/list',"RoleController@rolesList");
    Route::any('roles/edit/{id}',"RoleController@editRole");
});
