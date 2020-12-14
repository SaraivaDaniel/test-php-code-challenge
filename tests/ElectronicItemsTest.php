<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SaraivaDaniel\ElectronicItems;
use SaraivaDaniel\IElectronicItem;

class ElectronicItemsTest extends TestCase
{

    public function testCreatesInstanceWithNoParameters()
    {
        $electronicItems = new ElectronicItems();
        $this->assertSame(0.00, $electronicItems->getTotalPrice());
    }

    public function testCreatesInstanceWithParameters()
    {
        $mock_item_a = $this->createMock(IElectronicItem::class);
        $mock_item_a->expects($this->once())
            ->method('getPriceWithExtras')
            ->willReturn(10.00);

        $mock_item_b = $this->createMock(IElectronicItem::class);
        $mock_item_b->expects($this->once())
            ->method('getPriceWithExtras')
            ->willReturn(20.00);

        $items = [$mock_item_a, $mock_item_b];

        $electronicItems = new ElectronicItems($items);

        $this->assertSame(30.00, $electronicItems->getTotalPrice());
    }

    public function testCreatesInstanceWithWrongParameterType()
    {
        $mock_item_a = $this->createMock(ElectronicItems::class);
        $items = [$mock_item_a];

        $this->expectException(\TypeError::class);
        $items = new ElectronicItems($items);
    }

}