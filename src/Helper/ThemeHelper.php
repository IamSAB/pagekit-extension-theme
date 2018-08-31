<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\View\Helper\Helper;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Pagekit\Widget\Model\Widget;
use SAB\Extension\Theme\ThemeModule;

class ThemeHelper extends Helper
{
    // Content

    /**
     * Render a position
     *
     * @param   string  $position
     * @param   array   $config
     * @return  string
     */
    public function position(string $position, array $params = [])
    {
        if (empty($config)) {
            $config = $position;
        }
        $params = $this->getConfig('Position', $config);
        return $this->view->position($position, 'theme-core:views/position.php', $params);
    }

    /**
     * Render a widget
     *
     * @param Widget $widget
     * @return string
     */
    public function widget(Widget $widget)
    {
        $params = array_merge([
            'title' => $widget->title,
            'content' => $widget->get('result'),
        ], $widget->theme);

        return $this->view->render('theme-core:views/widget.php', $params);
    }

    /**
     * Render a custom template
     *
     * @param   string  $template
     * @param   array   $params
     * @return  string
     */
    public function custom(string $template, array $params = [])
    {
        return $this->view->render($template, $params);
    }

    // Wrapper

    /**
     * Render a section
     *
     * @param   string|array    $config
     * @return  string
     */
    public function section($config, string $content)
    {
        $params = $this->getConfig('Section', $config);
        $params['content'] = $content;
        $template = $params['cover'] ? 'section-cover.php' : 'section.php';
        return $this->view->render("theme-core:views/$template", $params);
    }

    /**
     * Do a nested render, last render must be a content method
     *
     * @param array $renders
     * @return string
     */
    public function nested(array $renders)
    {
        $content = '';
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

    // Misc

    /**
     * {@inheritdoc}
     */
    public function getName ()
    {
        return "tm";
    }

    /**
     * @param   string        $prefix
     * @param   string|array  $config
     * @return  array
     */
    protected function getConfig($prefix, $config)
    {
        return is_string($config) ? $this->view->params[$prefix.$config] : array_merge($config, constant(sprintf('%s::%s', ThemeModule::class, $prefix)));
    }
}
