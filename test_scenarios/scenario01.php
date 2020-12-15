<?php

use SaraivaDaniel\ElectronicItem\Console;
use SaraivaDaniel\ElectronicItem\Controller;
use SaraivaDaniel\ElectronicItem\Microwave;
use SaraivaDaniel\ElectronicItem\Television;
use SaraivaDaniel\ElectronicItems;

/*
 * CREATE SCENARIO REQUIRED BY TEST
 */

$console = new Console(300.30);
$console->addExtra(new Controller(30.50, true));
$console->addExtra(new Controller(25.40, true));
$console->addExtra(new Controller(50.20, false));
$console->addExtra(new Controller(60.10, false));

$tv1 = new Television(200.40);
$tv1->addExtra(new Controller(20.20, false));
$tv1->addExtra(new Controller(15.10, false));

$tv2 = new Television(400.50);
$tv2->addExtra(new Controller(17.70, false));

$microwave = new Microwave(100.80);

$scenario = new ElectronicItems();
$scenario->add($console)
    ->add($tv1)
    ->add($tv2)
    ->add($microwave);

/*
 * QUESTION 1
 * Sort items by price, then output total price
 */
echo "Question 1:\n";
echo str_repeat("=", 20) . "\n";

$items = $scenario->sortItems();
echo "Items sorted by price\n";

echo "Total pricing: " . $scenario->getTotalPrice() . "\n";

/*
 * QUESTION 2
 * How much the console and its controllers cost
 */
echo "\nQuestion 2:\n";
echo str_repeat("=", 20) . "\n";

$consoles = $scenario->getItemsByType(\SaraivaDaniel\ElectronicItem\Console::TYPE);

echo "Console and controllers cost: " . $consoles[0]->getPriceWithExtras();