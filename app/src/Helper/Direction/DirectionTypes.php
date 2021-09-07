<?php

namespace App\Helper\Direction;

use App\Contract\Direction;

class DirectionTypes
{
    public const EAST = "E";
    public const WEST = "W";
    public const SOUTH = "S";
    public const NORTH = "N";

    public static function direction(string $direction): Direction
    {
        switch ($direction) {
            case self::EAST:
                return new East();
            case self::WEST:
                return new West();
            case self::SOUTH:
                return new South();
            case self::NORTH:
                return new North();
        }
    }

    public static function ConvertDirectionToString(Direction $direction): string
    {
        switch(true) {
            case $direction instanceof East:
                return self::EAST;
            case $direction instanceof West:
                return self::WEST;
            case $direction instanceof South:
                return self::SOUTH;
            case $direction instanceof North:
                return self::NORTH;
        }
    }
}
