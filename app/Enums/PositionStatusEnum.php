<?php 
namespace App\Enums;
use Illuminate\Support\Str;

enum PositionStatusEnum : string {
    case PENDING = 'pending';
    case PUBLISH = 'publish';
    case SPAM = 'spam';

    /**
     * Get the values of the enum.
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
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
            $data[$value] = Str::ucfirst($value);
        }

        return $data;
    }

}