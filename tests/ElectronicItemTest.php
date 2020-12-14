<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
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

}