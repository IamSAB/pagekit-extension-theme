<?php

namespace SAB\Extension\Theme\Core;

class Menu extends Component
{
    public function render(string $menu)
    {
        $this->view->menu($menu, $this->template, $this->getOptions($menu));
    }

    public function item(Node $node, int $level = 0)
    {
        $options = compact('level');
        $options['root'] = $node;
        return $this->view->render('theme-core/recursive-nav.php', $options);
    }
}