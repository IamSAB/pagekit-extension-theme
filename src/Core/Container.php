<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;



class Container implements \IteratorAggregate
{
    protected $instance;

    protected $items;

    function __construct($instance)
    {
        $this->instance = $instance;
    }

    public function add(ItemInterface $item)
    {
        $this->items[$item->getName()] = $item;
    }

    public function get(string $name)
    {
        if (Arr::has($this->items, $name)) {
            $this->items[$name];
        }
    }

    public function remove(string $name)
    {
        if (Arr::has($this->items, $name)) {
            unset($this->items[$name]);
        }
    }

    public function getIterator()
    {
        return $this->items;
    }
}