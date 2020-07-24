<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');

});

Route::get('admin','AdminController@index');
Route::resource('admin/driver','DriverController')->except(['show']);
Route::resource('admin/notification','NotificationController')->except(['edit','update']);
Route::get('admin/service','ServiceController@index');
Route::resource('admin/location','LocationController')->except(['show']);
Route::delete('admin/service/{id}','ServiceController@destroy');
Route::get('admin/service/final','ServiceController@finalService');
Route::get('admin/service/canceled','ServiceController@canceled');
Route::get('admin/service/{id}','ServiceController@show');
Route::get('admin/map','AdminController@map');
Route::post('admin/map/get_driver_location','AdminController@get_driver_location');
Route::get('admin/profile','AdminController@profile');
Route::post('admin/profile','AdminController@update_profile');
Route::get('admin/setting/location/price','AdminController@location_price');
Route::post('admin/setting/location/price','AdminController@set_location_price');
Route::post('admin/service/change_status/{id}','ServiceController@chancel');

Route::get('admin_login','Auth\LoginController@showLoginForm')->name('login');
Route::post('admin_login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');

Route::get('payment/{payment_code}','PaymentController@connect');
Route::get('payment/verify','PaymentController@verify');
