<?php


namespace SaraivaDaniel\Importer;


use SaraivaDaniel\ElectronicItem;
use SaraivaDaniel\IElectronicItem;

interface IElectronicItemFactory
{

    /**
     * @param $type
     * @return IElectronicItem|ElectronicItem
     */
    public function getInstance($type): IElectronicItem;

}