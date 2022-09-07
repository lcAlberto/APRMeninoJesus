<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 26/06/22
 * Time: 21:17
 */

Route::get('/', 'AuthController@welcome')->name('welcome');
Route::post('login', 'AuthController@login')->name('login');
Route::post('/register', 'AuthController@register')->name('register');
Route::post('/verify', 'AuthController@verify')->name('verification.verify');

//Auth::routes(['verify' => true]);
