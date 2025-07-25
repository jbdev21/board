<?php

namespace App\Enums;

use App\Traits\HasBasicEnumTraits;

enum SalaryTypeEnum: string
{
    use HasBasicEnumTraits;

    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case BI_WEEKLY = 'bi_weekly';
    case MONTHLY = 'monthly';
    case ANNUALLY = 'annually';
    case YEARLY = 'yearly';
    case PER_PROJECT = 'per_project';
    case COMMISSION = 'commission';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return self::labels()[$this->value];
    }

    public static function labels(): array
    {
        return [
            self::HOURLY->value => 'Hourly',
            self::DAILY->value => 'Daily',
            self::WEEKLY->value => 'Weekly',
            self::BI_WEEKLY->value => 'Bi-Weekly',
            self::MONTHLY->value => 'Monthly',
            self::ANNUALLY->value => 'Annually',
            self::YEARLY->value => 'Yearly',
            self::PER_PROJECT->value => 'Per Project',
            self::COMMISSION->value => 'Commission-Based',
        ];
    }
}
