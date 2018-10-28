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
        foreach ($this->tm as $comName => $component) {
            $component->register($view);
            foreach ($component as $elName => $element) {
                $element->setOptions($view->params[$comName][$elName]);
            }
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
        $params = $widget->theme;
        $params['title'] = $widget->title;
        $params['content'] = $widget->get('result');
        $params['h_default_style'] = 'uk-card-title';
        return $this->view->render('theme-core/widget.php', $params);
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
