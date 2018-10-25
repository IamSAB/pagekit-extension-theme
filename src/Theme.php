<?php

namespace SAB\Extension\Theme;

use Pagekit\Application;
use SAB\Extension\Theme\Core\Collection;
use Pagekit\Module\Loader\LoaderInterface;
use Pagekit\Util\Arr;
use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Core\Element;
use SAB\Extension\Theme\Core\Container;
use SAB\Extension\Theme\Core\ItemInterface;


class Theme implements LoaderInterface
{
    const UI_SITE       = 'node';
    const UI_SETTINGS   = 'config';

    protected $app;

    protected $components;

    function __construct(Application $app)
    {
        $this->app = $app;
        $this->components = new Container();
    }

    public function register(ItemInterface $component)
    {
        $this->components[$component->getName()] = $component;
    }

    public function add(string $component, Element $element)
    {
        $this->components->get($component)->add($element);
    }

    protected function prefix($string)
    {
        return 'tm-'.$string;
    }

    public function load($module)
    {
        $dependencies = [
            self::UI_SITE => [],
            self::UI_SETTINGS => [],
            'widget' => []
        ];

        $ui = [
            self::UI_SITE => [],
            self::UI_SETTINGS => []
        ];

        foreach($this->components as $name => $component) {

            $dependencies[$component->getUi()][] = $this->prefix($component->getName());

            if ($component->canEditDefaultOptions() && !$this->app['theme']->has('options-'.$component->getName())) {
                $module['config']['options-'.$component->getName()] = $component->getDefaultOptions();
            }

            if ($component instanceOf PositionInterface) {
                $module['positions'][$component->getName()] = $component->getName();
                $module['widget'][$component->getName()] = $component->getWidgetDefaultOptions();
                $dependencies['widget'][] = $this->prefix('widget-'.$component->getName());
            }

            $options = $this->app['config']->get('options-'.$component->getName(), $component->getDefaultOptions());

            foreach ($component as $name => $element) {
                $module[$component->getUi()][$component->getName()][$element->getName()] = $options;
                $ui[$component->getUi()][] = [
                    'component' => $component->getName(),
                    'element' => $element->getName(),
                    'title' => $element->getTitle(),
                    'description' => $element->getDescription()
                ];
            }
        }

        $module->options['events'] = [
            'view.init' => function ($event, $view) {
                $view->addHelper(new ThemeHelper($this));
            },
            'view.scripts' => function ($scripts, $view) {
                foreach($this->components as $name => $component) {
                    $scripts->register(
                        $this->prefix($component->getName()),
                        $component->getScript()
                    );
                    if ($component instanceOf PositionInterface) {
                        $scripts->register(
                            $this->prefix('widget-'.$component->getName()),
                            $component->getWidgetScript()
                        );
                    }
                }
            },
            'view.system/site/admin/edit' => function ($event, $view) use($ui, $dependencies) {
                $view->data('$components', new \stdClass());
                $view->data('$ui', $ui[self::UI_SITE]);
                $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $dependencies[self::UI_SITE]);
            },
            'view.system/site/widget/edit' => function ($event, $view) {
                $view->data('$positions', new \stdClass());
                $dependencies = [];
                foreach ($this->components as $name => $component) {
                    if ($component instanceOf PositionInterface) {
                        $dependencies[] = $this->prefix($component->getName());
                    }
                }
                $view->script('widget-theme', 'theme-core:app/bundle/widget-theme.js');
                $view->script('widget-theme-positions', 'theme-core:app/bundle/widget-theme.js', $dependencies);
            },
            'view.system/site/settings' => function ($event, $view) use ($ui, $dependencies) {
                $view->data('$components', new \stdClass());
                $view->data('$ui', $ui[self::UI_SETTINGS]);
                $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies[self::UI_SETTINGS]);
            },
        ];
    }
}
