<?php

namespace SAB\Extension\Theme;

use Pagekit\Application;
use SAB\Extension\Theme\Core\Collection;
use Pagekit\Module\Loader\LoaderInterface;
use Pagekit\Util\Arr;
use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Core\Element;
use SAB\Extension\Theme\Core\Container;


class Theme implements LoaderInterface
{
    const UI_SITE       = 0;
    const UI_WIDGET     = 1;
    const UI_SETTINGS   = 2;

    const COLLECTION_DEFAULT = 'default';

    protected $app;

    protected $components;

    protected $elements;

    protected $collections;

    function __construct(Application $app)
    {
        $this->app = $app;
        $this->components = new Container(Component::class);
        $this->collections = new Container(Collection::class);

        $this->collections->add(new Collection(self::COLLECTION_DEFAULT, self::UI_SETTINGS));
    }

    public function com(Component $component)
    {
        $element = new Element($component->getName());
        $this->collections->get(self::COLLECTION_DEFAULT)->add($element);

        $this->components->add($component);
    }

    public function col(Collection $collection)
    {
        $this->collections->add($collection);
    }

    public function getUiData($ui)
    {
        $arr = [];
        foreach($this->collections as $name => $collection) {
            if ($ui == $collection->getUi()) {
                $arr[$collection->getName()] = $collection->getData();
            }
        }
        return $arr;
    }

    protected function getUiDependencies($ui)
    {
        $groups = [];
        foreach ($this->collections as $name => $collection) {
            if ($ui == $collection->getUi()) {
                $arr = Arr::merge($arr, $collection->getRequiredComponents());
            }
        }
        return $arr;
    }

    public function getKey(Collection $collection, Element $element)
    {
        return implode('-',[$collection->getName(), $element->getName()]);
    }

    public function load($module)
    {
        $module->options['events'] = [
            'view.init' => function ($event, $view) {
                $view->addHelper(new ThemeHelper($this));
            },
            'view.scripts' => function ($scripts, $view) {
                foreach($this->collections as $collection) {
                    foreach ($this->components as $name => $component) {
                        $scripts->register($name, $component);
                    }
                }
            },
            'view.system/site/admin/edit' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$ui', $this->getUiData(self::UI_SITE));
                $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $this->getUiDependencies(self::UI_SITE));
            },
            'view.system/site/admin/edit' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$ui', $this->getUiData(self::UI_WIDGET));
                $view->script('node-theme', 'theme-core:app/bundle/widget-theme.js', $this->getUiDependencies(self::UI_WIDGET));
            },
            'view.system/site/admin/edit' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$ui', $this->getUiData(self::UI_SETTINGS));
                $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $this->getUiDependencies(self::UI_SETTINGS));
            },
        ];

        foreach($this->collections as $collection) {
            foreach($collection as $element) {
                Arr::set($module, implode('.', [$collection->getUi(), $this->theme->getKey($collection, $element)]));
            }
        }
    }
}
