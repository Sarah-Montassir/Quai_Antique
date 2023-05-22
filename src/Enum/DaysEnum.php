<?php

namespace App\Enum;

enum DaysEnum: string
{
    case Monday = 'Lundi';
    case Tuesday = 'Mardi';
    case Wednesday = 'Mercredi';
    case Thursday = 'Jeudi';
    case Friday = 'Vendredi';
    case Saturday = 'Samedi';
    case Sunday = 'Dimanche';

    public static function getValues(): array
    {
        return [
            self::Monday,
            self::Tuesday,
            self::Wednesday,
            self::Thursday,
            self::Friday,
            self::Saturday,
            self::Sunday
        ];
    }

    public static function getByDay(string $day)
    {
        return current(array_filter(self::getValues(), fn($dayEnum) => ($dayEnum->value === $day)));
    }

}
