<?php

use Illuminate\Support\Facades\Route;

Route::get('/hotel', function () {
    return view('welcome');
});