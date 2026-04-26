<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;



Route::get('/test', function () {
    return response()->json([
        "message" => "Payment Service aktif"
    ]);
});


Route::get('/payments', function () {
    return response()->json([
        [
            "payment_id" => 1001,
            "order_id" => 1,
            "status" => "SUCCESS"
        ],
        [
            "payment_id" => 1002,
            "order_id" => 2,
            "status" => "PENDING"
        ]
    ]);
});


Route::get('/payments/{id}', function ($id) {
    return response()->json([
        "payment_id" => $id,
        "order_id" => $id,
        "status" => "SUCCESS"
    ]);
});


Route::post('/payments/{orderId}', function ($orderId) {

    try {
        $order = Http::get("http://127.0.0.1:8003/api/orders/$orderId")->json();
    } catch (\Exception $e) {
        $order = [
            "order_id" => $orderId,
            "status" => "dummy (order service belum jalan)"
        ];
    }

    return response()->json([
        "payment_id" => rand(1000,9999),
        "order_id" => $orderId,
        "status" => "SUCCESS",
        "order" => $order
    ]);
});


Route::put('/payments/{id}', function ($id) {
    return response()->json([
        "payment_id" => $id,
        "status" => "UPDATED"
    ]);
});
 

Route::delete('/payments/{id}', function ($id) {
    return response()->json([
        "message" => "Payment $id deleted"
    ]);
});