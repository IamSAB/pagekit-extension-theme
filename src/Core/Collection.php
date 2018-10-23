<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Application;


class Collection implements \JsonSerializable, ItemInterface
{
    const MODE_ALL    = 0;
    const MODE_SWITCH = 1;

    public $name;

    public $ui;

    public $mode;

    protected $elements = [];

    function __construct(string $name, $view = self::VIEW_SITE, $mode = self::MODE_ALL)
    {
        $this->name = $name;
        $this->view = $view;
        $this->mode = $mode;
        $this->elements = new Container(Element::class);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUi()
    {
        return $this->ui;
    }

    public function add($elements)
    {
        if(!is_array($elements)) {
            $elements = [$elements];
        }

        foreach ($elements as $element) {
            if ($element instanceOf Element) {
                $this->elements[$element->getName()] = $element;
            }
        }
    }

    public function getRequiredComponents()
    {
        $components = [];

        foreach ($this->elements as $element)
        {
            if (!in_arra($element->getComponent(), $components))
            {
                $components[] = $element->getComponent();
            }
        }

        return $components;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'mode' => $this->mode,
            'elements' => $this->elements
        ];
    }
}