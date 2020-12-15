<?php


namespace SaraivaDaniel;


interface IElectronicItem
{

    public function getPrice(): ?float;

    public function getPriceWithExtras(): float;

    public function getType(): string;

}