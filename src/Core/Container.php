<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;



class Container implements \IteratorAggregate
{
    protected $items;

    public function add(ItemInterface $item)
    {
        $this->items[$item->getName()] = $item;
    }

    public function get(string $name)
    {
        return Arr::get($this->items, $name);
    }

    public function remove(string $name)
    {
        Arr::remove($name);
    }

    public function getIterator()
    {
        return $this->items;
    }
}