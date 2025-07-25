<?php

namespace App\Enums;
use Illuminate\Support\Str;

enum CurrencyCodeEnum: string
{
    case USD = 'USD'; // US Dollar
    case EUR = 'EUR'; // Euro
    case GBP = 'GBP'; // British Pound
    case JPY = 'JPY'; // Japanese Yen
    case AUD = 'AUD'; // Australian Dollar
    case CAD = 'CAD'; // Canadian Dollar
    case CHF = 'CHF'; // Swiss Franc
    case CNY = 'CNY'; // Chinese Yuan
    case HKD = 'HKD'; // Hong Kong Dollar
    case SGD = 'SGD'; // Singapore Dollar
    case PHP = 'PHP'; // Philippine Peso
    case INR = 'INR'; // Indian Rupee
    case NZD = 'NZD'; // New Zealand Dollar
    case SEK = 'SEK'; // Swedish Krona
    case NOK = 'NOK'; // Norwegian Krone
    case DKK = 'DKK'; // Danish Krone
    case ZAR = 'ZAR'; // South African Rand
    case BRL = 'BRL'; // Brazilian Real
    case MXN = 'MXN'; // Mexican Peso
    case RUB = 'RUB'; // Russian Ruble

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function labels(): array
    {
        return [
            self::USD->value => 'US Dollar',
            self::EUR->value => 'Euro',
            self::GBP->value => 'British Pound',
            self::JPY->value => 'Japanese Yen',
            self::AUD->value => 'Australian Dollar',
            self::CAD->value => 'Canadian Dollar',
            self::CHF->value => 'Swiss Franc',
            self::CNY->value => 'Chinese Yuan',
            self::HKD->value => 'Hong Kong Dollar',
            self::SGD->value => 'Singapore Dollar',
            self::PHP->value => 'Philippine Peso',
            self::INR->value => 'Indian Rupee',
            self::NZD->value => 'New Zealand Dollar',
            self::SEK->value => 'Swedish Krona',
            self::NOK->value => 'Norwegian Krone',
            self::DKK->value => 'Danish Krone',
            self::ZAR->value => 'South African Rand',
            self::BRL->value => 'Brazilian Real',
            self::MXN->value => 'Mexican Peso',
            self::RUB->value => 'Russian Ruble',
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