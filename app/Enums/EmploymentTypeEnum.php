<?php

namespace App\Enums;

use App\Traits\HasBasicEnumTraits;

enum EmploymentTypeEnum: string
{
    use HasBasicEnumTraits;

    case PERMANENT = 'permanent';
    case FIXED_TERM = 'fixed_term';
    case INTERN = 'intern';
    case WORKING_STUDENT = 'working_student';
    case FREELANCE = 'freelance';
    case CONTRACT = 'contract';
    case TEMPORARY = 'temporary';
    case PART_TIME = 'part_time';
    case APPRENTICESHIP = 'apprenticeship';
    case SEASONAL = 'seasonal';
    case VOLUNTEER = 'volunteer';
    case TRAINEE = 'trainee';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::PERMANENT->value => 'Permanent',
            self::FIXED_TERM->value => 'Fixed Term',
            self::INTERN->value => 'Intern',
            self::WORKING_STUDENT->value => 'Working Student',
            self::FREELANCE->value => 'Freelance',
            self::CONTRACT->value => 'Contract',
            self::TEMPORARY->value => 'Temporary',
            self::PART_TIME->value => 'Part-time',
            self::APPRENTICESHIP->value => 'Apprenticeship',
            self::SEASONAL->value => 'Seasonal',
            self::VOLUNTEER->value => 'Volunteer',
            self::TRAINEE->value => 'Trainee',
        ];
    }

}