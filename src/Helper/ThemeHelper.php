<?php

namespace SAB\Penta\Helper;

use Pagekit\View\Helper\Helper;
use SAB\Penta\Theme;

class ThemeHelper extends Helper
{
    /**
     * Render a wrapper section
     *
     * @param   string|array    $config
     * @return  ThemeHelper
     */
    public function section($config)
    {
        $params = $this->getConfig('Section', $config);
        $template = $params['cover'] ? 'section-cover.php' : 'section.php';
        return $this->wrapper("theme-core:views/$template", $params);
    }

    /**
     * Render a position
     *
     * @param   string  $position
     * @param   array   $config
     * @return  string
     */
    public function position(string $position, array $config = [])
    {
        if (empty($config)) $config = $position;
        $params = $this->getConfig('Position', $config);
        return $this->wrap($this->view->position($position, 'theme-core:views/position.php', $params));
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
        return $this->wrap($this->view->render($template, $params));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

    /**
     * Set a wrapper
     *
     * @param   string          $template
     * @param   string|array    $config
     * @return  ThemeHelper
     */
    protected function wrapper(string $template, $config = [])
    {
        $this->wrapper = [
            'template' => $template,
            'config' => $config
        ];

        return $this;
    }

    /**
     * Wrap a rendered content
     *
     * @param   string  $content
     * @return  string
     */
    protected function wrap(string $content)
    {
        if (!empty($this->wrapper)) {
            $this->wrapper['config']['content'] = $content;
            return $this->view->render($this->wrapper['template'], $this->wrapper['config']);
        }
        else {
            return $content;
        }
    }

    /**
     * @param   string        $prefix
     * @param   string|array  $config
     * @return  array
     */
    protected function getConfig($prefix, $config)
    {
        return is_string($config) ? $this->view->params[$prefix.$config] : array_merge($config, constant(sprintf('%s::%s', Theme::class, $prefix)));
    }
}
