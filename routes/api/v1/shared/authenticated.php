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

Route::get('borrowings', 'BorrowingsController@index');
Route::post('borrowings', 'BorrowingsController@store');
Route::get('borrowing/{id}', 'BorrowingsController@show');
Route::put('borrowing/{id}', 'BorrowingsController@update');
Route::delete('borrowing/{id}', 'BorrowingsController@destroy');

