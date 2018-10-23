<?php

namespace SAB\Extension\Theme\Core;

class MenuComponent extends Component
{
    function render(View $view, $options)
    {
        return $view->menu($this->name, $this->template, $options);
    }
}