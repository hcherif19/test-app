<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:anctum')->get('/user', function (Request $request) {
    return $request->user();
});


