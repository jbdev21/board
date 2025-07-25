<?php

namespace App\Traits;
use Illuminate\Support\Str;

trait HasBasicEnumTraits
{
    public function label(): string
    {
        return self::labels()[$this->value];
    }

    /**
     * Get the values of the enum.
     *
     * @return array
     */
    public static function associativeValues(): array
    {
        $data = [];
        foreach (self::values() as $value) {
            $data[$value] = self::labels()[$value];
        }

        return $data;
    }
}
