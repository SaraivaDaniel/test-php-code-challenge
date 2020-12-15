<?php


namespace Tests;


use PHPUnit\Framework\TestCase;
use SaraivaDaniel\Importer\IElectronicItemFactory;
use SaraivaDaniel\Importer\LoadFromJson;
use Tests\Fixtures\ElectronicItemExtra;
use Tests\Fixtures\ElectronicItemTypeA;
use Tests\Fixtures\InvalidClass;

class LoadFromJsonTest extends TestCase
{
    public function testEmptyBagIfEmptyJson()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $json = "[]";

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);

        $this->assertEquals(0, $items->count());
    }

    public function testExceptionIfInvalidJson()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $json = "[invalid string]";

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid JSON");

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);
    }

    public function testLoadSingleItem()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $mock_factory->expects($this->once())
            ->method('getInstance')
            ->with(ElectronicItemTypeA::TYPE)
            ->willReturn(new ElectronicItemTypeA());

        $json = '[{ "type": "type_a", "data": { "price": 100.00 }}]';

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);

        $this->assertEquals(1, $items->count());
        $this->assertEquals(100.00, $items->getTotalPrice());
        $this->assertCount(1, $items->getItemsByType(ElectronicItemTypeA::TYPE));
    }


    public function testLoadMultipleItems()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $mock_factory->expects($this->exactly(2))
            ->method('getInstance')
            ->with(ElectronicItemTypeA::TYPE)
            ->willReturn(new ElectronicItemTypeA());

        $json = '[{ "type": "type_a", "data": { "price": 100.00 }}, { "type": "type_a", "data": { "price": 200.00 }}]';

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);

        $this->assertEquals(2, $items->count());
        $this->assertEquals(300.00, $items->getTotalPrice());
        $this->assertCount(2, $items->getItemsByType(ElectronicItemTypeA::TYPE));
    }

    public function testLoadItemWithExtra()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $mock_factory->expects($this->exactly(2))
            ->method('getInstance')
            ->with($this->logicalOr(
                $this->equalTo(ElectronicItemTypeA::TYPE),
                $this->equalTo(ElectronicItemExtra::TYPE)
            ))
            ->will($this->returnCallback(function($value) {
                if ($value === ElectronicItemTypeA::TYPE) return new ElectronicItemTypeA();
                if ($value === ElectronicItemExtra::TYPE) return new ElectronicItemExtra();
            }));

        $json = '[{ "type": "type_a", "data": { "price": 100.00 }, "extras": [ { "type": "extra", "data": { "price": 50.00 }} ] }]';

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);

        $this->assertEquals(1, $items->count());
        $this->assertEquals(150.00, $items->getTotalPrice());
        $this->assertCount(1, $items->getItemsByType(ElectronicItemTypeA::TYPE));
    }

    public function testMissingKeys()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $mock_factory->expects($this->never())
            ->method('getInstance')
            ->with(ElectronicItemTypeA::TYPE)
            ->willReturn(new ElectronicItemTypeA());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid item specification");

        $json = '[{ "type": "type_a", "option": { "price": 100.00 }}]';

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);
    }

    public function testInvalidOption()
    {
        $mock_factory = $this->createMock(IElectronicItemFactory::class);
        $mock_factory->expects($this->once())
            ->method('getInstance')
            ->with(ElectronicItemTypeA::TYPE)
            ->willReturn(new ElectronicItemTypeA());

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Invalid option regular");

        $json = '[{ "type": "type_a", "data": { "regular": 100.00 }}]';

        $loader = new LoadFromJson($mock_factory);
        $items = $loader->load($json);
    }
}