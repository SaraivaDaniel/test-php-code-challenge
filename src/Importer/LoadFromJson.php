<?php


namespace SaraivaDaniel\Importer;


use SaraivaDaniel\ElectronicItem;
use SaraivaDaniel\ElectronicItem\IExtra;
use SaraivaDaniel\ElectronicItems;
use SaraivaDaniel\IElectronicItem;

class LoadFromJson
{

    private IElectronicItemFactory $factory;

    /**
     * LoadFromJson constructor.
     * @param IElectronicItemFactory $factory
     */
    public function __construct(IElectronicItemFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $json
     * @return ElectronicItems
     * @throws \Exception
     */
    public function load(string $json): ElectronicItems
    {
        $json_items = json_decode($json, true);
        if ($json_items === null) {
            throw new \Exception("Invalid JSON");
        }

        $result = new ElectronicItems();

        foreach ($json_items as $json_item) {
            $item = $this->getItem($json_item);
            $result->add($item);
        }

        return $result;
    }

    /**
     * @param array $json_item
     * @return ElectronicItem|ElectronicItem\IAcceptExtras|IElectronicItem|IExtra
     * @throws \Exception
     */
    private function getItem(array $json_item): ElectronicItem
    {
        if (!isset($json_item['type']) || !isset($json_item['data'])) {
            throw new \Exception("Invalid item specification");
        }

        $item = $this->factory->getInstance($json_item['type']);
        $this->setClassData($item, $json_item['data']);
        $this->loadExtras($item, $json_item['extras'] ?? []);

        return $item;
    }

    /**
     * @param ElectronicItem $item
     * @param array $data
     * @throws \Exception
     */
    private function setClassData(ElectronicItem $item, array $data)
    {
        foreach ($data as $key => $value) {
            $fn = 'set' . ucfirst($key);

            if (!method_exists($item, $fn)) {
                throw new \Exception("Invalid option $key");
            }

            $item->$fn($value);
        }
    }

    /**
     * @param $item
     * @param array $extras
     * @throws \Exception
     */
    private function loadExtras($item, array $extras)
    {
        foreach ($extras as $e => $json_extra) {
            $extra = $this->getItem($json_extra);
            $item->addExtra($extra);
        }
    }

}