<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SaraivaDaniel\ElectronicItems;
use SaraivaDaniel\IElectronicItem;
use Tests\Fixtures\InvalidClass;

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
        $mock_item_a = $this->createMock(InvalidClass::class);
        $items = [$mock_item_a];

        $this->expectException(\TypeError::class);
        $items = new ElectronicItems($items);
    }

    public function testGetSortedItemsAsc() {
        $mock_item_a = $this->createMock(IElectronicItem::class);
        $mock_item_a->expects($this->any())
            ->method('getPriceWithExtras')
            ->willReturn(20.00);

        $mock_item_b = $this->createMock(IElectronicItem::class);
        $mock_item_b->expects($this->any())
            ->method('getPriceWithExtras')
            ->willReturn(10.00);

        $items = [$mock_item_a, $mock_item_b];

        $electronicItems = new ElectronicItems($items);
        $sorted_asc = $electronicItems->getSortedItems(true);

        $this->assertSame(10.00, $sorted_asc[0]->getPriceWithExtras());
        $this->assertSame(20.00, $sorted_asc[1]->getPriceWithExtras());

        $sorted_desc = $electronicItems->getSortedItems(false);
        $this->assertSame(20.00, $sorted_desc[0]->getPriceWithExtras());
        $this->assertSame(10.00, $sorted_desc[1]->getPriceWithExtras());
    }


}