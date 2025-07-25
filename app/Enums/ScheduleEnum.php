<?php
namespace App\Enums;
use Illuminate\Support\Str;

enum ScheduleEnum: string
{
    case FULL_TIME = 'full_time';
    case PART_TIME = 'part_time';
    case FLEXIBLE = 'flexible';
    case SHIFT = 'shift';
    case WEEKEND = 'weekend';
    case NIGHT = 'night';
    case ROTATING = 'rotating';
    case REMOTE = 'remote';
    case HYBRID = 'hybrid';
    case ON_SITE = 'on_site';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::FULL_TIME->value => 'Full-Time',
            self::PART_TIME->value => 'Part-Time',
            self::FLEXIBLE->value => 'Flexible',
            self::SHIFT->value => 'Shift',
            self::WEEKEND->value => 'Weekend',
            self::NIGHT->value => 'Night',
            self::ROTATING->value => 'Rotating',
            self::REMOTE->value => 'Remote',
            self::HYBRID->value => 'Hybrid',
            self::ON_SITE->value => 'On-Site',
        ];
    }

    /**
     * Get the values of the enum.
     *
     * @return array
     */
    public static function associativeValues(): array
    {
        $data = [];
        foreach(self::values() as $value){
            $data[$value] = self::labels()[$value];
        }

        return $data;
    }

}