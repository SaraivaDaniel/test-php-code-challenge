<?php


namespace Tests\Fixtures;


use SaraivaDaniel\ElectronicItem;

class ElectronicItemTypeA extends ElectronicItem
{

    const TYPE = 'type_a';

    public function getPriceWithExtras(): float
    {
        return 0;
    }
}