<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\View\Helper\Helper;
use Pagekit\Widget\Model\Widget;
use Pagekit\Site\Model\Node;
use Pagekit\Util\Arr;
use Pagekit\Module\Module;
use SAB\Extension\Theme\Theme;

class ThemeHelper extends Helper
{
    protected $widget = null;

    function __construct(Theme $theme)
    {
        $this->theme = $theme;
    }

    public function recursiveNav($node, $level = 0)
    {
        $params = compact('level');
        $params['root'] = $node;
        return $this->view->render('theme-core:views/recursive-nav.php', $params);
    }

    public function position($name)
    {
        $this->view->position($name, 'theme-core/position.php');
    }

    public function widget(Widget $widget)
    {
        $this->widget = $widget;
        $res = $this->view->render('theme-core/widget.php');
        $this->widget = null;
        return $res;
    }

    // Other

    /**
     * Render a setting
     * $args[0] : setting name
     * $args[1 ...] : setting args
     *
     * @param string $setting
     * @param array $args
     * @return void
     */
    function __call(string $col, array $args)
    {
        $el = array_shift($args);
        $collection = $this->theme->collections->get($col);
        $element = $collection->elements->get($el);
        $component = $this->theme->components->get($element->getComponent());
        $options = $this->view->params[$this->theme->getKey($collection, $element)];
        $args = array_combine($component->getArgs(), $args);
        $options = Arr::merge($options, $args);
        return $component->render($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

}
