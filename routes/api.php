<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/files/store', 'API\FileController@storeConferenceImage')->name('store-conference-image');
//Route::delete('/files/store', 'API\FileController@removeConferenceImage')->name('remove-conference-image');

Route::get('/conference', 'API\ConferenceController@index')->name('get-conferences');
Route::get('/conference','API\ConferenceController@index')->name('get-conferences');
Route::get('/conference/{id}','API\ConferenceController@edit')->name('get-conference');
Route::post('/test','API\AuthController@test')->name('test');
Route::post('/conference','API\ConferenceController@store')->name('store-conference');
Route::post('/domain/search','API\DomainController@doSearch')->name('domain-search');
