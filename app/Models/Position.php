<?php

namespace App\Models;

use App\Enums\CurrencyCodeEnum;
use App\Enums\EmploymentTypeEnum;
use App\Enums\PositionStatusEnum;
use App\Enums\SalaryTypeEnum;
use App\Enums\ScheduleEnum;
use App\Enums\SeniorityEnum;
use App\Notifications\NewPositionNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class Position extends Model
{
    /** @use HasFactory<\Database\Factories\PositionFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'salary_type' => SalaryTypeEnum::class,
        'employment_type' => EmploymentTypeEnum::class,
        'seniority' => SeniorityEnum::class,
        'salary_currency_code' => CurrencyCodeEnum::class,
        'schedule' => ScheduleEnum::class,
        'status' => PositionStatusEnum::class,
    ];

     protected static function boot()
    {
        parent::boot(); 
        static::created(function ($position) {
            if($position->status == PositionStatusEnum::PENDING){
                $moderators = User::where("is_moderator", 1)->get();
                Notification::send($moderators, new NewPositionNotification($position));
            }
        });
    }



}
