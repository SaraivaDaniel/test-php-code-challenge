<?php

namespace SaraivaDaniel;

class ElectronicItems
{

    /**
     * @var IElectronicItem[]
     */
    private array $items = array();
    private float $total = 0;

    /**
     * ElectronicItems constructor.
     * @param IElectronicItem[] $items
     */
    public function __construct(array $items = [])
    {
        // as we can't type hint an array of ElectronicItem, I'll use self::add() for each item to type check it.
        // I could use splat operator (...) with type hint, but that would require clients of this class to remember to spread the input
        // as a side benefit, it'll already keep $total updated
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Adds an electronic item to the bag
     * @param IElectronicItem $item
     */
    public function add(IElectronicItem $item)
    {
        $this->items[] = $item;
        $this->total += $item->getPriceWithExtras();
    }

    public function getTotalPrice(): float
    {
        return $this->total;
    }

    /**
     * Returns the items depending on the sorting type requested
     *
     * @return array
     */
    public function getSortedItems($type)
    {
        $sorted = array();
        foreach ($this->items as $item)
        {
            $sorted[($item->price * 100)] = $item;
        }
        return ksort($sorted, SORT_NUMERIC);
    }
    /**
     *
     * @param string $type
     * @return array
     */
    public function getItemsByType($type)
    {
        if (in_array($type, ElectronicItem::$types))
        {
            $callback = function($item) use ($type)
            {
                return $item->type == $type;
            };
            $items = array_filter($this->items, $callback);
        }
        return false;
    }
}