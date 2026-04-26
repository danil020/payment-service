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
            "booking_id" => 1,
            "status" => "SUCCESS"
        ],
        [
            "payment_id" => 1002,
            "booking_id" => 2,
            "status" => "PENDING"
        ]
    ]);
});

Route::get('/payments/{id}', function ($id) {
    return response()->json([
        "payment_id" => $id,
        "booking_id" => $id,
        "status" => "SUCCESS"
    ]);
});

Route::post('/payments/{bookingId}', function ($bookingId) {

    try {
        $response = Http::get("http://127.0.0.1:8003/api/bookings/$bookingId");

        if ($response->failed()) {
            return response()->json([
                "error" => "Booking tidak ditemukan"
            ], 404);
        }

        $booking = $response->json();

    } catch (\Exception $e) {
        $booking = [
            "booking_id" => $bookingId,
            "status" => "dummy (booking service belum jalan)"
        ];
    }

    return response()->json([
        "payment_id" => rand(1000,9999),
        "booking_id" => $bookingId,
        "status" => "SUCCESS",
        "booking" => $booking
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