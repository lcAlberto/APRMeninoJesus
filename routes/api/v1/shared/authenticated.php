<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 26/06/22
 * Time: 21:17
 */

Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');
Route::post('user/organization', 'AuthController@createOrganization');
Route::post('logout', 'AuthController@logout');
