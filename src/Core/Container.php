<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;


class Container implements \IteratorAggregate
{
    private $class;

    private $items = [];

    function __construct(string $class)
    {
        $this->class = $class;
    }

    public function add($items)
    {
        if (!is_array($items)) {
            $items = [$items];
        }

        foreach ($items as $item) {
            if ($item instanceOf Iteminterface && $item instanceOf $this->class) {
                Arr::set($this->items, $item->getName(), $item);
            }
        }
    }

    /**
     * Get item
     *
     * @param string|array $name
     * @return ItemInterface $item
     */
    public function get($name)
    {
        return Arr::get($this->items, $name);
    }

    /**
     * Remove item(s)
     *
     * @param string|array $name
     * @return void
     */
    public function remove($name)
    {
        Arr::remove($this->items, $name);
    }

    public function count()
    {
        return count($this->items);
    }

    public function keys()
    {
        return array_keys($this->items);
    }

    /**
     * Get iterator
     *
     * @return array
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }
}