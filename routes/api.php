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

Route::get('/conferences','API\ConferenceController@index')->name('get-conferences');
Route::get('/conference/{id}','API\ConferenceController@edit')->name('edit-conference');
Route::put('/conference/{id}','API\ConferenceController@update')->name('update-conference');
Route::delete('/conference/{id}', 'API\ConferenceController@destroy')->name('remove-conference');
Route::post('/conference','API\ConferenceController@store')->name('store-conference');

Route::post('/conference/{id}/themes/','API\ThemeController@store')->name('store-theme');
Route::get('/conference/{id}/themes/','API\ThemeController@index')->name('get-themes');
Route::delete('/themes/{id}','API\ThemeController@destroy')->name('delete-theme');
Route::post('/themes/{id}','API\ThemeController@edit')->name('edit-theme');

Route::post('/theme-leaders/find-user','API\ThemeLeaderController@user')->name('find-user-theme-leader');
Route::post('/theme-leaders', 'API\ThemeLeaderController@store')->name('store-theme-leader');


