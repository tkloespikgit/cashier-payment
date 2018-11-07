<?php


// auth portal

Route::any('login',"AuthController@loginPortal");

Route::group(['middleware'=> 'adminGuard'],function (){

    Route::any('logout',"AuthController@logout");

//index
    Route::get('/',"IndexController@index")->name('dashboard');
    Route::get('/dashboard',"IndexController@index");

//user control
    Route::any('user/create',"UserController@createUser");
    Route::any('user/list',"UserController@createUser");

//admin control
    Route::any('admin/create',"AuthController@createAdmin");
    Route::any('admin/list',"AuthController@listAdmin");
    Route::any('permissions/list',"PermissionController@listPermission");
});
