<?php


namespace Tests\Fixtures;


use SaraivaDaniel\ElectronicItem;

class ElectronicItemTypeUndefined extends ElectronicItem
{

    public function getPriceWithExtras(): float
    {
        return 0;
    }
}