<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'HomeController@index');
  Route::get('/users/{id}', 'UsersController@show');
  Route::resource('devices', 'DevicesController');
  Route::get('/usages', 'DeviceUsagesController@index');
  Route::get('/usages/switchDevice', 'DeviceUsagesController@switchDevice');
});

Route::get('/home', 'HomeController@index');
Route::resource('users', 'UsersController');
Route::get('/vectors', 'VectorsController@index');
Route::get('/vectors/user/{id}', 'VectorsController@user');
