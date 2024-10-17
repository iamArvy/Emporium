<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    dd("Hello");
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return "Hello";
});