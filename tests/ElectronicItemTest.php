<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SaraivaDaniel\Exception\MaxExtrasException;
use Tests\Fixtures\ElectronicItemExtra;
use Tests\Fixtures\ElectronicItemTypeA;
use Tests\Fixtures\ElectronicItemTypeUndefined;

class ElectronicItemTest extends TestCase
{

    public function testCreatesInstance()
    {
        $item = new ElectronicItemTypeA(10);

        $this->assertEquals(10.00, $item->getPrice());
        $this->assertEquals(ElectronicItemTypeA::TYPE, $item->getType());
    }

    public function testExceptionThrownIfTypeUndefined()
    {
        $this->expectException(\Exception::class);

        $item = new ElectronicItemTypeUndefined(10);
        $item->getType();
    }

    public function testGetPriceWithExtrasEmpty()
    {
        $item = new ElectronicItemTypeA(10);

        $this->assertEquals(10.00, $item->getPriceWithExtras());
    }

    public function testAddsExtraItem()
    {
        $item = new ElectronicItemTypeA(10);
        $extra = new ElectronicItemExtra(20);

        $item->addExtra($extra);

        $this->assertEquals(30.00, $item->getPriceWithExtras());
    }

    public function testFailsIfMoreThanMaxExtras()
    {
        $item = new ElectronicItemTypeA(10);
        $extra1 = new ElectronicItemExtra(20);
        $extra2 = new ElectronicItemExtra(20);

        $this->expectException(MaxExtrasException::class);

        $item->addExtra($extra1);
        $item->addExtra($extra2);
    }

}