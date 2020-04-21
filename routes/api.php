<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/files/image', 'API\FileController@image')->name('get-image');
Route::post('/files/store', 'API\FileController@storeFile')->name('store-file');

Route::get('/conference', 'API\ConferenceController@index')->name('get-conferences');
Route::get('/conference','API\ConferenceController@index')->name('get-conferences');
Route::get('/conference/{id}','API\ConferenceController@edit')->name('get-conference');
Route::post('/test','API\AuthController@test')->name('test');
Route::post('/conference','API\ConferenceController@store')->name('store-conference');
Route::post('/domain/search','API\DomainController@doSearch')->name('domain-search');
