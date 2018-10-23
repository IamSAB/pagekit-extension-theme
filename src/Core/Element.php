<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Module\Module;
use Pagekit\View\View;
use Pagekit\View\Helper\ScriptHelper;

class Element implements \JsonSerializable, ItemInterface
{
    protected $name;

    protected $component;

    function __construct(string $name, string $component)
    {
        $this->name =  $name;
        $this->component = $component;
    }

    public function getComponent()
    {
        return $this->component;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'component' => $this->component
        ];
    }
}