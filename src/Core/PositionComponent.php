<?php

namespace SAB\Extension\Theme\Core;

class PositionComponent extends Component
{
    function render(View $view, $options)
    {
        return $view->position($this->name, $this->template, $options);
    }
}