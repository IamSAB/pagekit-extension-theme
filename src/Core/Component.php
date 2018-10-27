<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;


abstract class Component extends Container implements ItemInterface
{
    const DEFAULT_OPTIONS_FOR_NON_ELEMENTS = 0;
    const REFUSE_NON_ELEMENTS = 1;

    function __construct()
    {
        parent::__construct(Element::class);
    }

    public function setElementOptions(array $options)
    {
        foreach ($this as $name => $element) {
            if (Arr::has($options, $name)) {
                $element->setOptions($options[$name]);
            }
        }
    }

    public function getElementOptions(string $element, int $option = self::DEFAULT_OPTIONS_FOR_NON_ELEMENTS)
    {
        if ($element && $this->has($element)) {
            return $this->get($element)->getOptions();
        }
        elseif ($option == self::REFUSE_NON_ELEMENTS ) {
            throw new \InvalidArgumentException('Element is not registered.');
        }
        else {
            return $this->getDefaultOptions();
        }
    }

    public function getTags()
    {
        return [$this->getName()];
    }

    public static function editableDefaultOptions()
    {
        return true;
    }

    abstract public static function getDefaultOptions();

    abstract public static function getScript();

    abstract public static function getUi();

    abstract public function getName();
}