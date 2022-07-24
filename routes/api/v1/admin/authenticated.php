<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 26/06/22
 * Time: 20:57
 */

Route::get('partners', 'PartnersController@index');
Route::post('partners', 'PartnersController@store');
Route::get('partner/{id}', 'PartnersController@show');
Route::put('partner/{id}', 'PartnersController@update');
Route::delete('partner/{id}', 'PartnersController@destroy');

Route::get('patrimonies', 'PatrimoniesController@index');
Route::post('patrimonies', 'PatrimoniesController@store');
Route::get('patrimony/{id}', 'PatrimoniesController@show');
Route::put('patrimony/{id}', 'PatrimoniesController@update');
Route::delete('patrimony/{id}', 'PatrimoniesController@destroy');

Route::get('managements', 'ManagementController@index');
Route::post('managements', 'ManagementController@store');
Route::get('management/{id}', 'ManagementController@show');
Route::put('management/{id}', 'ManagementController@update');
Route::delete('management/{id}', 'ManagementController@destroy');
