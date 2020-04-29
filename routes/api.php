<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/conference/image', 'API\ConferenceImageController@store')->name('store-conference-image');
Route::delete('/conference/image/{id}', 'API\ConferenceImageController@destroy')->name('remove-conference-image');
Route::get('/conference/image/{id}', 'API\ConferenceImageController@show')->name('show-conference-image');
Route::get('/conference/image/download/{id}', 'API\ConferenceImageController@download')->name('download-conference-image');

Route::get('/conference','API\ConferenceController@index')->name('get-conferences');
Route::put('/conference/{id}','API\ConferenceController@update')->name('update-conference');
Route::delete('/conference/{id}', 'API\ConferenceController@destroy')->name('remove-conference');
Route::post('/conference','API\ConferenceController@store')->name('store-conference');
Route::post('/domain/search','API\DomainController@doSearch')->name('domain-search');
