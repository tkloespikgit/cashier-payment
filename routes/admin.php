<?php

//index
Route::get('/',"IndexController@index")->name('dashboard');
Route::get('/dashboard',"IndexController@index");


// auth portal

Route::any('login',"AuthController@loginPortal");


//user control

Route::any('user/create',"UserController@createUser");
Route::any('user/list',"UserController@createUser");

//admin control

Route::any('admin/create',"AuthController@createAdmin");
Route::any('admin/list',"AuthController@listAdmin");