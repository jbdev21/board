<?php

use App\Http\Controllers\PositionUpdateStatusController;
use App\Http\Controllers\PostingController;
use App\Models\Position;
use App\Models\User;
use App\Notifications\NewPositionNotification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/posting", [PostingController::class, 'index']);

Route::get("/position-status/{position}", PositionUpdateStatusController::class)->name("position-update-status-link");

Route::get("/status/success", function(){
    return "update been applied!";
});
