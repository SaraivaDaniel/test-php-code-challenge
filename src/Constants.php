<?php

namespace SaraivaDaniel;

use SaraivaDaniel\ElectronicItem\Console;
use SaraivaDaniel\ElectronicItem\Controller;
use SaraivaDaniel\ElectronicItem\Microwave;
use SaraivaDaniel\ElectronicItem\Television;

class Constants
{
    private static $types_map = [
        Console::TYPE => Console::class,
        Microwave::TYPE => Microwave::class,
        Television::TYPE => Television::class,
        Controller::TYPE => Controller::class,
    ];

    /**
     * Return array of type => class map
     * @return string[]
     */
    public static function getClassMap()
    {
        return static::$types_map;
    }

}