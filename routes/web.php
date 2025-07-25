<?php

use App\Http\Controllers\PositionUpdateStatusController;
use App\Http\Controllers\PostingController;
use App\Models\Position;
use App\Models\User;
use App\Notifications\NewPositionNotification;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostingController::class, 'index'])->name("home");
Route::get('/job/{position}', [PostingController::class, 'show'])->name("job");

Route::get("/position-status/{position}", PositionUpdateStatusController::class)->name("position-update-status-link");

Route::get("/status/success", function(){
    return "update been applied!";
});
