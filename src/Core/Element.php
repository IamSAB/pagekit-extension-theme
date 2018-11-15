<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Module\Module;
use Pagekit\View\View;
use Pagekit\View\Helper\ScriptHelper;

class Element implements ItemInterface
{
    protected $name;
    public $title;
    public $description;
    protected $options = [];

    function __construct(string $name, string $title = '', string $description = '')
    {
        $this->name =  $name;
        $this->title = $title ? $title : ucfirst($name);
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }
}