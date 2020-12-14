<?php

namespace SaraivaDaniel;

use SaraivaDaniel\ElectronicItem\Console;
use SaraivaDaniel\ElectronicItem\Controller;
use SaraivaDaniel\ElectronicItem\Microwave;
use SaraivaDaniel\ElectronicItem\Television;

class Constants
{
    private static $types = array(
        Console::TYPE,
        Microwave::TYPE,
        Television::TYPE,
        Controller::TYPE,
    );
}