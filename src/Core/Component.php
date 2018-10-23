<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\View\View;


class Component implements ItemInterface
{
    protected $name;

    protected $options;

    protected $template;

    protected $script;

    protected $args;

    protected $ifs = [];

    function __construct(string $name, array $options, string $template, string $script, array $args = [])
    {
        $this->name = $name;
        $this->options = $options;
        $this->template = $template;
        $this->script = $script;
        $this->args = $args;
    }

    public function render(View $view, $options)
    {
        return $view->render($this->template, $options);
    }

    public function addIf($path, $condition)
    {
        $this->ifs[$path] = $condition;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function getScript()
    {
        return $this->script;
    }

    public function getArgs()
    {
        return $this->args;
    }

}