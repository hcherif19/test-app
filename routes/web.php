<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// api/v1
Route::group(['prefix' => 'api/v1','namespace' => 'App\Http\Controllers\Api\V1'], function () {
    Route::apiResource('customers', 'CustomerController');
    Route::apiResource('invoices', 'InvoiceController');
});

