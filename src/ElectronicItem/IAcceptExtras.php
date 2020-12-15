<?php


namespace SaraivaDaniel\ElectronicItem;

/**
 * Interface IAcceptExtras
 * Indicates that an electronic item accept other extras
 * @package SaraivaDaniel\ElectronicItem
 */
interface IAcceptExtras
{

    public function addExtra(IExtra $electronicItem): self;
}