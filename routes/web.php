<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response([
        'message' => 'payment service is running'
    ]);
});
