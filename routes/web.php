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
Route::get('/', 'GuestController@index');

Route::view('/static/service', 'static.service');
Route::view('/static/right', 'static.right');
Route::view('/static/pay', 'static.pay');
Route::view('/static/contact', 'static.contact');
Route::view('/static/agreement', 'static.agreement');

Route::get('/admin', 'AdminController@index');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
if(env('APP_DEBUG', false) == true){
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
}

Route::resource('post', 'PostController');
Route::get('/list', 'PostController@list');
Route::resource('claim', 'ClaimController');

Route::get('/captcha', 'CaptchaController@index');