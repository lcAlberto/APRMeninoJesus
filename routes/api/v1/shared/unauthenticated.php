<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 26/06/22
 * Time: 21:17
 */

Route::get('/', 'AuthController@wellcome');
Route::post('login', 'AuthController@login');
