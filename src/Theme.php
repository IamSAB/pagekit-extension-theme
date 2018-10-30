<?php

namespace SAB\Extension\Theme;

use Pagekit\Application;
use Pagekit\Module\Module;
use Pagekit\Module\Loader\LoaderInterface;
use Pagekit\Util\Arr;
use Pagekit\Event\Event;
use Pagekit\View\View;
use Pagekit\View\Event\ViewEvent;
use Pagekit\View\Asset\AssetManager;
use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Core\Element;
use SAB\Extension\Theme\Core\Container;
use SAB\Extension\Theme\Core\ItemInterface;
use SAB\Extension\Theme\Core\PositionInterface;
use SAB\Extension\Theme\Helper\ThemeHelper;
use SAB\Extension\Theme\Component\GridPosition;
use SAB\Extension\Theme\Component\HeroPosition;
use SAB\Extension\Theme\Component\Section;


class Theme extends Container implements LoaderInterface, \IteratorAggregate
{
    const UI_SITE       = 'node';
    const UI_SETTINGS   = 'config';

    protected $app;

    protected $components;

    function __construct(Application $app)
    {
        parent::__construct(Component::class);

        $this->app = $app;

        $this->add(new GridPosition());
        $this->add(new HeroPosition());
        $this->add(new Section());
    }

    public function prefix($string)
    {
        return 'tm-'.$string;
    }

    public function load($module)
    {
        // only load into a module if its a theme which explicitely requires theme-core
        if ($module['type'] == 'theme' && isset($module['require']) && $module['require'] == 'theme-core') {

            if (isset($module['theme']) && is_callable($module['theme'])) {
                call_user_func_array($module['theme'],[$this]);
            }

            $dependencies = [
                self::UI_SITE => ['site-edit'],
                self::UI_SETTINGS => ['site-settings'],
                'widget' => ['widget-edit'] // TODO constant for widget?
            ];

            $ui = [
                self::UI_SITE => [],
                self::UI_SETTINGS => [],
                'widget' => []
            ];

            $module['widget'] = [
                'h_style' => '',
                'h_tag' => 'h3',
                'h_link' => false,
                'classes' => '',
                'header' => '',
                'footer' => ''
            ];

            foreach($this as $comName => $component) {

                $dependencies[$component->getUi()][] = $this->prefix($comName);

                if ($component->editableDefaultOptions()) {
                    $dependencies[Theme::UI_SETTINGS][] = $this->prefix($comName); // TODO component could be added again
                    $module['config'][$comName]['default'] = $component->getDefaultOptions();
                    $ui[Theme::UI_SETTINGS][] = [
                        'component' => $comName,
                        'element' => 'default',
                        'title' => 'Defaults for '.ucfirst($comName),
                        'tags' => ['defaults']
                    ];
                }

                $isPosition = $component instanceOf PositionInterface;

                if ($isPosition) {
                    $module['widget'][$comName] = $component->getWidgetDefaultOptions();
                    $dependencies['widget'][] = $this->prefix('widget-'.$comName);
                }

                $options = $this->app['config']->get($module['name'])->get($comName.'.default', $component->getDefaultOptions()); // TODO always check config?

                foreach ($component as $elName => $element) {
                    $module[$component->getUi()][$comName][$elName] = $options;
                    $ui[$component->getUi()][] = [
                        'component' => $comName,
                        'element' => $elName,
                        'title' => $element->getTitle(),
                        'description' => $element->getDescription(),
                        'tags' => Arr::merge($component->getTags(), $element->getTags())
                    ];

                    if($isPosition) {
                        $module['positions'][$elName] = $element->getTitle();
                        $ui['widget'][$comName][] = $elName; // needed to determine which widget-position-* script to use for a position
                    }
                }

            }

            $theme = $this;
            $themeName = $module['name'];
            $themeConfig = $this->app['config']->get($module['name']);

            $module['events'] = [
                'site' => function (Event $event, Application $app) { // only triggered when in frontend
                    $app->on('view.init', function (Event $event, View $view) use ($app) {
                        $view->addHelper(new ThemeHelper($app['tm']));
                    });
                },
                'admin' => function (Event $event, Application $app) {
                    $app->on('view.scripts', function (Event $event, AssetManager $scripts) use ($app) {
                        foreach($theme as $name => $component) {
                            if ($component->count()) {
                                if ($component->getScript()) {
                                    $scripts->register(
                                        $theme->prefix($name),
                                        $component->getScript()
                                    );
                                }
                                if ($component instanceOf PositionInterface && $component->getWidgetScript()) { // register widget position script
                                    $scripts->register(
                                        $theme->prefix('widget-'.$name),
                                        $component->getWidgetScript()
                                    );
                                }
                            }
                        }
                    });
                },
                'view.system/site/admin/edit' => function (ViewEvent $event, View $view) use ($ui, $dependencies) {
                    $view->data('$components', new \stdClass());
                    $view->data('$ui', $ui[Theme::UI_SITE]);
                    $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $dependencies[Theme::UI_SITE]);
                },
                'view.system/widget/edit' => function (ViewEvent $event, View $view) use ($ui, $dependencies)  {
                    $view->data('$positions', new \stdClass());
                    $view->data('$ui', $ui['widget']);
                    $view->script('widget-layout', 'theme-core:app/bundle/widget-layout.js', ['widget-edit']);
                    $view->script('widget-position', 'theme-core:app/bundle/widget-position.js', $dependencies['widget']);
                },
                'view.system/site/admin/settings' => function (ViewEvent $event, View $view) use ($themeConfig, $ui, $dependencies) {
                    $view->data('$themeName', $this->options['name']); // $this refers to Module instance (where callback is executed)
                    $view->data('$themeConfig', $themeConfig);
                    $view->data('$components', new \stdClass());
                    $view->data('$ui', $ui[Theme::UI_SETTINGS]);
                    $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies[Theme::UI_SETTINGS]);
                },
            ];

        }

        return $module;
    }
}
