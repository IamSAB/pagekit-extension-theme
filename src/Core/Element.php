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

    protected $tags;

    protected $options = [];

    function __construct(string $name, array $tags = [], string $title = '', string $description = '')
    {
        $this->name =  $name;
        $this->tags = $tags;
        $this->title = $title ? $title : ucfirst($name);
        $this->description = $description;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    public function getOptions()
    {
        return $this->options;
    }
}