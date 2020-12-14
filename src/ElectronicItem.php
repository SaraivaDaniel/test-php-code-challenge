<?php

namespace SaraivaDaniel;

abstract class ElectronicItem implements IElectronicItem
{

    const TYPE = '';

    /**
     * @var float
     */
    private $price;

    public function __construct(float $price)
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
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

}