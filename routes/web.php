<?php

use App\Http\Controllers\PositionUpdateStatusController;
use App\Models\Position;
use App\Models\User;
use App\Notifications\NewPositionNotification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/position-status/{position}", PositionUpdateStatusController::class)->name("position-update-status-link");

Route::get("/status/success", function(){
    return "update been applied!";
});

Route::get('/notification', function () {
    $user = User::first();
    $position = Position::first();
    return (new NewPositionNotification($position))
        ->toMail($user);
});