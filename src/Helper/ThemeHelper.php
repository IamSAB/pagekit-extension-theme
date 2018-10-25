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

    function __call(string $component, array $args)
    {
        $component = $this->theme->component($component);
        $component->setOptions($this->view->params[$component->getName()]);
        return $component;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

}
