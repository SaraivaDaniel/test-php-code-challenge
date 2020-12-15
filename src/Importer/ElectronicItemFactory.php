<?php


namespace SaraivaDaniel\Importer;


use SaraivaDaniel\ElectronicItem;
use SaraivaDaniel\ElectronicItem\IAcceptExtras;
use SaraivaDaniel\IElectronicItem;

class ElectronicItemFactory implements IElectronicItemFactory
{

    private $classmap;

    /**
     * LoadFromJson constructor.
     * @param array $classmap an array of the form $type => $classname
     */
    public function __construct(array $classmap)
    {
        $this->classmap = $classmap;
    }

    /**
     * Returns an instance of an ElectronicItem given a string type
     * @param $type
     * @return IElectronicItem|IAcceptExtras
     * @throws \Exception if invalid $type
     */
    public function getInstance($type): IElectronicItem
    {
        $class = $this->classmap[$type];

        if (!class_exists($class) || !in_array(ElectronicItem::class, class_parents($class))) {
            throw new \Exception("Invalid class for type {$type} (should be an existing class and should extend ElectronicItem)");
        }

        return new $class();
    }

}