<?php

namespace App\Models;

use App\Enums\PositionStatusEnum;
use App\Notifications\NewPositionNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status'
    ];

     protected static function boot()
    {
        parent::boot(); 
        static::created(function ($position) {
            Log::info($position->status);
            if($position->status == PositionStatusEnum::PENDING->value){
                Log::info("hehe");
                $moderators = User::where("is_moderator", 1)->get();
                Notification::send($moderators, new NewPositionNotification($position));
            }
        });
    }



}
