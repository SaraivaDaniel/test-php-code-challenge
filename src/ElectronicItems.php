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
     * Returns the items sorted by price
     * @param bool $sort_asc Sort ascending if true, or descending if false
     * @param bool $with_extras Whether to include or not extras in price calculation
     * @return array
     */
    public function getSortedItems(bool $sort_asc = true, bool $with_extras = true): array
    {
        // - Changed to replace use of ksort() as it would fail if two items happened to have same price
        //   The latter items would replace former ones added to $sorted array
        // - Renamed $type parameter to $sort_asc option to be more clear
        // - Added $with_extras option to sort considering extras or not
        // - Replaced function to sort current array, instead of creating another one

        $callback = function (IElectronicItem $a, IElectronicItem $b) use ($sort_asc, $with_extras) {
            // we use order to invert the result of the comparison function, in case we want it descending
            $order = ($sort_asc) ? 1 : -1;

            if ($with_extras) {
                return ($a->getPriceWithExtras() - $b->getPriceWithExtras()) * $order;
            } else {
                return ($a->getPrice() - $b->getPrice()) * $order;
            }
        };

        usort($this->items, $callback);

        return $this->items;
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