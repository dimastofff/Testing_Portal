<?php

namespace App\Models;

enum Role : int
{
    case Unauthorized = 0;
    case User = 1;
    case Moderator = 2;
    case Admin = 3;

    public static function fromName(string $name): Role
    {
        foreach (self::cases() as $case) {
            if( $name === $case->name ){
                return $case;
            }
        }
        throw new \ValueError($name . ' is not a valid value for enum ' . self::class);
    }
}
