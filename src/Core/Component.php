<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;


abstract class Component
{
    protected $elements;

    protected $options = [];

    public function __construct()
    {
        $this->elements = new Container();
    }

    public function add(Element $element)
    {
        $this->elements->set($element);
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOptions(Element $element)
    {
        return Arr::get($this->options, $element->getName(), []);
    }

    abstract public function getDefaultOptions();

    abstract public function getScript();

    abstract public function getUi();
}