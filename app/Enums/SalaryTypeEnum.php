<?php

namespace App\Enums;
use Illuminate\Support\Str;

enum SalaryTypeEnum: string
{
    case HOURLY = 'hourly';
    case DAILY = 'daily';
    case WEEKLY = 'weekly';
    case BI_WEEKLY = 'bi_weekly';
    case MONTHLY = 'monthly';
    case ANNUALLY = 'annually';
    case PER_PROJECT = 'per_project';
    case COMMISSION = 'commission';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
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
            self::PER_PROJECT->value => 'Per Project',
            self::COMMISSION->value => 'Commission-Based',
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