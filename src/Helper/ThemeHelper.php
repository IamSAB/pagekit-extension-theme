<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\View\Helper\Helper;
use Pagekit\Widget\Model\Widget;
use SAB\Extension\Theme\ThemeModule;
use Pagekit\Site\Model\Node;
use Pagekit\Util\Arr;
use Pagekit\Module\Module;

class ThemeHelper extends Helper
{
    protected $widget = null;

    function __construct(array $methods)
    {
        $this->methods = $methods;
    }

    protected function theme()
    {
        return $this->widget ? $this->widget : $this->theme;
    }

    // Util

    /**
     * Apply one or more wrapper to a renderer
     *
     * @param   array   $renders
     * @return  string
     */
    public function nested(array $wrapper, string $renderer, array $args)
    {
        $content = call_user_func_array([$this, $renderer], $args);
        foreach (array_reverse($renders) as $method => $args)
        {
            if (!method_exists($this, $method)) {
                throw new MethodNotFoundException('You can only use helper methods', get_class($this), $method);
            }
            if ($content) $args[] = $content;
            $content = call_user_func_array([$this, $method], $args);
        }
        return $content;
    }

    public function recursiveNav($node, $level = 0)
    {
        $params = compact('level');
        $params['root'] = $node;
        return $this->view->render('theme-core:views/recursive-nav.php', $params);
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
    function __call(string $component, array $args)
    {
        if (isset($this->methods[$component])) {
            throw new \BadMethodCallException(sprintf('No setting %s registered.', $setting));
        }

        $method = $this->methods[$component];
        $name = $args[0];

        if (!isset($method[$name])) {
            throw new \InvalidArgumentException(sprintf('No setting %s with name %s loaded.', $setting, $name));
        }

        if (!isset($method[$name]['php'])) {
            return "<div>Could not find template '$template' for setting '$setting' with name '{$name}'</div>";
        }

        $config = $this->view->params[$component][$name];
        $combine = array_combine($method['args'], array_slice($args, 1, count($method['args'])));

        return $this->view->render($template, array_merge($combine, $this->view->params[$component][$name]));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

}
