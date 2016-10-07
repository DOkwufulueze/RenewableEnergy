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
  Route::get('/admin/home', 'Admin\HomeController@index');
  Route::resource('/admin/user-location-distributors', 'Admin\UserLocationDistributorController');
  Route::resource('/admin/distributors', 'Admin\DistributorsController');
  Route::resource('/admin/locations', 'Admin\LocationsController');
  Route::resource('/admin/location-distributors', 'Admin\LocationDistributorsController');
});

Route::get('/home', 'HomeController@index');
Route::resource('users', 'UsersController');
Route::get('/vectors', 'VectorsController@index');
Route::get('/vectors/user/{id}', 'VectorsController@user');
Route::get('/vectors/energy-distributor/{id}', 'VectorsController@energyDistributor');
