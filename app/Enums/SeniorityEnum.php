<?php

namespace App\Enums;

use App\Traits\HasBasicEnumTraits;

enum SeniorityEnum: string
{
    use HasBasicEnumTraits;

    case INTERN = 'intern';
    case TRAINEE = 'trainee';
    case STUDENT = 'student';
    case JUNIOR = 'junior';
    case EXPERIENCED = 'experienced';
    case MID = 'mid';
    case SENIOR = 'senior';
    case LEAD = 'lead';
    case MANAGER = 'manager';
    case DIRECTOR = 'director';
    case VP = 'vp';
    case FOUNDER = 'founder';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::INTERN->value => 'Intern',
            self::TRAINEE->value => 'Trainee',
            self::STUDENT->value => 'Student',
            self::JUNIOR->value => 'Junior',
            self::EXPERIENCED->value => 'Experienced',
            self::MID->value => 'Mid-Level',
            self::SENIOR->value => 'Senior',
            self::LEAD->value => 'Lead',
            self::MANAGER->value => 'Manager',
            self::DIRECTOR->value => 'Director',
            self::VP->value => 'Vice President',
            self::FOUNDER->value => 'Founder',
        ];
    }

}