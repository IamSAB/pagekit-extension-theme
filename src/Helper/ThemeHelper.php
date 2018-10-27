<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\View\Helper\Helper;
use Pagekit\Site\Model\Node;
use SAB\Extension\Theme\Theme;
use Pagekit\Widget\Model\Widget;
use Pagekit\Application;
use Pagekit\View\View;


class ThemeHelper extends Helper
{
    protected $widget = null;

    /**
     * Constructor
     *
     * @param Theme $tm
     */
    function __construct(Theme $tm)
    {
        $this->tm = $tm;
    }

    public function register(View $view)
    {
        $this->view = $view;
        foreach ($this->tm as $name => $component) {
            $component->setElementOptions($this->view->params[$name]);
        }
    }

    /**
     * Recursive render nav nodes (not inteded as start point)
     *
     * @param Node $node
     * @param integer $level
     * @return void
     */
    public function recursiveNav(Node $node, int $level = 0)
    {
        $params = compact('level');
        $params['root'] = $node;
        return $this->view->render('theme-core/recursive-nav.php', $params);
    }

    public function widget(Widget $widget)
    {
        $this->view->render('theme-core/widget.php', compact('widget'));
    }

    /**
     * Get a registered component
     *
     * @param string $component
     * @param array $args
     * @return Component
     */
    function __call(string $component, $args = [])
    {
        return $this->tm->get($component);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

}
