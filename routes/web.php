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
Route::get('/admin', 'AdminController@index');

Auth::routes();

Route::resource('post', 'PostController');
Route::resource('claim', 'ClaimController');

Route::get('/captcha', 'CaptchaController@index');
Route::post('/upload', 'UploadController@index');