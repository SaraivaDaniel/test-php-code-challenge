<?php


namespace SaraivaDaniel\ElectronicItem;


use SaraivaDaniel\ElectronicItem;

class Controller extends ElectronicItem implements IExtra
{

    const TYPE = 'controller';

    private ?bool $wired;

    /**
     * Controller constructor.
     * @param float $price
     * @param bool $wired
     */
    public function __construct(?float $price = null, ?bool $wired = null)
    {
        parent::__construct($price);
        $this->wired = $wired;
    }

    /**
     * Return true if wired, or false if remote
     * @return bool
     */
    public function getWired(): ?bool
    {
        return $this->wired;
    }

    public function setWired(bool $wired): self
    {
        $this->wired = $wired;
        return $this;
    }

}