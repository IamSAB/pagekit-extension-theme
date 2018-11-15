<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\Util\Arr;
use Pagekit\View\View;


class Component extends Container implements ItemInterface
{
    protected $view;

    protected $name;
    protected $template;
    public $description;
    public $script;
    public $options;

    function __construct(string $name, string $script, string $template, array $options, string $description = '')
    {
        parent::__construct(Element::class);

        $this->name = $name;
        $this->script = $script;
        $this->template = $template;
        $this->options = $options;
        $this->description = $description;
    }

    public function getTitle()
    {
        return ucfirst($this->name);
    }

    public function register(View $view)
    {
        $this->view = $view;
    }

    public function render(string $el)
    {
        $options = $this->getOptions($el);

        return $this->view->render($this->template, $options);
    }

    protected function getOptions(string $el = '')
    {
        if ($el && $this->has($el)) {
            return $this->view->params->get("{$this->name}.$el", []);
        }
        else {
            return $this->view->params->get("defaults.{$this->name}", $this->options);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getClass()
    {
        return (new \ReflectionClass($this))->getShortName();
    }
}