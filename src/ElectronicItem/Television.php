<?php


namespace SaraivaDaniel\ElectronicItem;


use SaraivaDaniel\ElectronicItem;

class Television extends ElectronicItem
{

    const TYPE = 'television';
    /**
     * There are no max extras by requirement, but should not have more than max integer size in platform
     * We could also use BCMath for unlimited integer, but that would be unnecessary
     */
    const MAX_EXTRAS = PHP_INT_MAX;

}