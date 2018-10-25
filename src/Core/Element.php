<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Module\Module;
use Pagekit\View\View;
use Pagekit\View\Helper\ScriptHelper;

class Element implements ItemInterface
{
    protected $name;

    protected $title;

    protected $description;

    function __construct(string $name, string $title, string $description)
    {
        $this->name =  $name;
        $this->title = $title;
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
}