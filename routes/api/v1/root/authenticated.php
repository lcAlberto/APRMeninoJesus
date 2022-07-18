<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 26/06/22
 * Time: 20:57
 */

Route::get('organizations', 'OrganizationController@index');
Route::post('organizations', 'OrganizationController@store');
Route::get('organizations/{id}', 'OrganizationController@show');
Route::put('organization/{id}', 'OrganizationController@update');
Route::delete('organization/{id}', 'OrganizationController@destroy');
