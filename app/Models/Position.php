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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        'external_created_at' => 'datetime'
    ];

     protected static function boot()
    {
        parent::boot(); 
        static::created(function ($position) {
            if(Auth::check()){
                $position->update(['user_id' => Auth::user()->id]);
            }
            if($position->user){
                if($position->user->had_posted == false){
                    $moderators = User::where("is_moderator", 1)->get();
                    $position->update(['status' => PositionStatusEnum::PENDING]);
                    Notification::send($moderators, new NewPositionNotification($position));
                    $position->user()->update(['had_posted' => true]);
                }
            }   
        });
    }

    function user(){
        return $this->belongsTo(User::class);
    }

}
