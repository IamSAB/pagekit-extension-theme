<?php

namespace SAB\Extension\Theme\Core;

class Position extends Component
{
    public $widgetScript;
    public $widgetOptions;

    function __construct(string $name, string $script, string $template, array $options, string $widgetScript, array $widgetOptions, string $description = '')
    {
        parent::__construct($name, $script, $template, $options, $description);
        $this->widgetScript = $widgetScript;
        $this->widgetOptions = $widgetOptions;
    }

    public function render(string $position)
    {
        return $this->view->position($position, $this->template, $this->getOptions($position));
    }
}