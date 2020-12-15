<?php

use SaraivaDaniel\ElectronicItem\Console;
use SaraivaDaniel\ElectronicItem\Controller;
use SaraivaDaniel\ElectronicItem\Microwave;
use SaraivaDaniel\ElectronicItem\Television;
use SaraivaDaniel\ElectronicItems;

/*
 * ALTERNATE SCENARIO
 */
$scenario = new ElectronicItems();

$console = new Console(300.30);
$console->addExtra(new Controller(30.50, true));
$console->addExtra(new Controller(25.40, true));
$console->addExtra(new Controller(50.20, false));
$console->addExtra(new Controller(60.10, false));

// try to add a fifth controller, should throw exception
$console->addExtra(new Controller(70.10, false));

$scenario->add($console);

echo "Total pricing: " . $scenario->getTotalPrice() . "\n";