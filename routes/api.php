<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BtcController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/rate', [BtcController::class, 'getCurrentRate']);
Route::post('/subscribe', [BtcController::class, 'subscribeEmail']);
Route::post('/sendEmails', [BtcController::class, 'sendEmails']);

