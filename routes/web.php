<?php

use Illuminate\Support\Facades\Route;

//Dealing with all requests rendering the SPA vue-router handles the rendering of different components

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
