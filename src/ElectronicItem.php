<?php

namespace SaraivaDaniel;

use SaraivaDaniel\ElectronicItem\IAcceptExtras;
use SaraivaDaniel\ElectronicItem\IExtra;
use SaraivaDaniel\Exception\MaxExtrasException;

abstract class ElectronicItem implements IElectronicItem, IAcceptExtras
{

    const TYPE = '';
    const MAX_EXTRAS = 0;

    private ?float $price;
    protected ElectronicItems $extras;

    public function __construct(?float $price = null)
    {
        $this->price = $price;
        $this->extras = new ElectronicItems();
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function getPriceWithExtras(): float
    {
        return $this->price + $this->extras->getTotalPrice();
    }

    public function getType(): string
    {
        $type = static::TYPE;

        if ($type === '') {
            throw new \Exception("Class type not defined");
        }

        return $type;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @param ElectronicItem $electronicItem
     * @return ElectronicItem
     * @throws MaxExtrasException
     */
    public function addExtra(IExtra $electronicItem): self
    {
        if ($this->extras->count() >= static::MAX_EXTRAS) {
            throw new MaxExtrasException("Max extras reached: " . static::TYPE . " allows only " . static::MAX_EXTRAS . " extras");
        }

        $this->extras->add($electronicItem);
        return $this;
    }

}