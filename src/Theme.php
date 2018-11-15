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
use SAB\Extension\Theme\Core\Section;
use SAB\Extension\Theme\Core\Position;
use SAB\Extension\Theme\Core\Menu;
use SAB\Extension\Theme\Core\ItemInterface;
use SAB\Extension\Theme\Helper\ThemeHelper;


class Theme extends Container implements LoaderInterface, \IteratorAggregate
{

    protected $app;

    protected $components;

    function __construct(Application $app)
    {
        parent::__construct(Component::class);

        $this->app = $app;
    }

    public function load($module)
    {
        // only load into a module if its a theme which explicitely requires theme-core
        if ($module['type'] == 'theme' && isset($module['require']) && $module['require'] == 'theme-core') {

            if (isset($module['theme']) && is_callable($module['theme'])) {
                call_user_func_array($module['theme'],[$this]);
            }

            $module['widget']['heading'] = ThemeHelper::OPTIONS_HEADING;

            $module['node'] = [
                'heading' => ThemeHelper::OPTIONS_HEADING,
                'menu' => [
                    'subtitle' => '',
                    'icon' => '',
                    'header' => '',
                    'divider' => false
                ]
            ];

            foreach ($this as $name => $component) {
                $module['config'][$name] = $component->options;
                if ($component instanceOf Position) {
                    $module['widget'][$name] = $component->widgetOptions;
                    foreach ($component as $position => $element) {
                        $module['positions'][$position] = $element->title;
                    }
                }
                if ($component instanceOf Menu) {
                    foreach ($component as $menu => $element) {
                        $module['menus'][$menu] = $element->title;
                    }
                }
                foreach ($component as $el => $element) {
                    $module['node'][$name][$el] = $component->options;
                    $module['node'][$name][$el]['default'] = true;
                }
            }

            // $dependencies = [
            //     self::UI_SITE => ['site-edit'],
            //     self::UI_SETTINGS => ['site-settings'],
            //     'widget' => ['widget-edit'] // TODO constant for widget?
            // ];

            // $ui = [
            //     self::UI_SITE => [],
            //     self::UI_SETTINGS => [],
            //     'widget' => []
            // ];

            // $module['widget'] = [
            //     'h_style' => '',
            //     'h_tag' => 'h3',
            //     'h_link' => false,
            //     'classes' => '',
            //     'header' => '',
            //     'footer' => ''
            // ];

            // foreach($this as $comName => $component) {

            //     $dependencies[$component->getUi()][] = $this->prefix($comName);

            //     if ($component->editableDefaultOptions()) {
            //         $dependencies[Theme::UI_SETTINGS][] = $this->prefix($comName); // TODO component could be added again
            //         $module['config'][$comName]['default'] = $component->getDefaultOptions();
            //         $ui[Theme::UI_SETTINGS][] = [
            //             'component' => $comName,
            //             'element' => 'default',
            //             'title' => 'Defaults for '.ucfirst($comName),
            //             'tags' => ['defaults']
            //         ];
            //     }

            //     $isPosition = $component instanceOf PositionInterface;

            //     if ($isPosition) {
            //         $module['widget'][$comName] = $component->getWidgetDefaultOptions();
            //         $dependencies['widget'][] = $this->prefix('widget-'.$comName);
            //     }

            //     $options = $this->app['config']->get($module['name'])->get($comName.'.default', $component->getDefaultOptions()); // TODO always check config?

            //     foreach ($component as $elName => $element) {
            //         $module[$component->getUi()][$comName][$elName] = $options;
            //         $ui[$component->getUi()][] = [
            //             'component' => $comName,
            //             'element' => $elName,
            //             'title' => $element->getTitle(),
            //             'description' => $element->getDescription(),
            //             'tags' => Arr::merge($component->getTags(), $element->getTags())
            //         ];

            //         if($isPosition) {
            //             $module['positions'][$elName] = $element->getTitle();
            //             $ui['widget'][$comName][] = $elName; // needed to determine which widget-position-* script to use for a position
            //         }
            //     }

            // }

            // $theme = $this;
            // $themeName = $module['name'];
            // $themeConfig = $this->app['config']->get($module['name']);

            $module['events'] = [

                'site' => function (Event $event, Application $app) { // only triggered when in frontend
                    $app->on('view.init', function (Event $event, View $view) use ($app) {
                        $view->addHelper(new ThemeHelper($app['tm']));
                    });
                },

                'admin' => function (Event $event, Application $app) {

                    $app->on('view.scripts', function (Event $event, AssetManager $scripts) use ($app) {
                        foreach($app['tm'] as $name => $component) {
                            if ($component->count()) {
                                if ($component->script) {
                                    $scripts->register($name, $component->script);
                                }
                                if ($component instanceOf Position && $component->widgetScript) { // register widget position script
                                    $scripts->register('widget-'.$name, $component->widgetScript);
                                }
                            }
                        }
                    });

                    $app->on('view.system/site/admin/edit', function (ViewEvent $event, View $view) use ($app) {
                        $ui = [];
                        $dependencies = ['site-edit'];

                        foreach ($app['tm'] as $name => $component) {
                            if ($component->count()) {
                                $dependencies[] = $name;
                                $isPosition = $component instanceOf Position;
                                $isMenu = $component instanceOf Menu;
                                foreach ($component as $el => $element) {
                                    $ui[] = [
                                        'component' => $name,
                                        'element' => $el,
                                        'title' => $element->title,
                                        'description' => $element->description,
                                        'type' => $component->getClass()
                                    ];
                                }
                            }
                        }

                        $view->data('$components', new \stdClass());
                        $view->data('$ui', $ui);
                        $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $dependencies);
                    });

                    $app->on('view.system/widget/edit', function (ViewEvent $event, View $view) use ($app)  {
                        $view->data('$components', new \stdClass());
                        $dependencies = ['widget-edit'];
                        foreach ($app['tm'] as $name => $component) {
                            if ($component instanceOf Position && $component->count()) {
                                $dependencies[] = 'widget-'.$name;
                                $ui[$name] =  [];
                                foreach ($component as $position => $element) {
                                    $ui[$name][] = $position;
                                }
                            }
                        }
                        $view->data('$ui', $ui);
                        $view->script('widget-theme', 'theme-core:app/bundle/widget-theme.js', $dependencies);
                    });

                    $app->on('view.system/site/admin/settings', function (ViewEvent $event, View $view) use ($app) {

                        $view->data('$themeName', $this->options['name']); // $this refers to Module instance (where callback is executed)
                        $view->data('$themeConfig', $this->config());
                        $view->data('$components', new \stdClass());

                        $ui = [];
                        $dependencies = ['site-settings'];

                        foreach ($app['tm'] as $name => $component) {
                            if ($component->count()) {
                                $dependencies[] = $name;
                                $ui[] = [
                                    'component' => $name,
                                    'title' => $component->getTitle(),
                                    'description' => $component->description
                                ];
                            }
                        }
                        $view->data('$ui', $ui);
                        $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies);
                    });

                },

                // 'view.system/site/admin/edit' => function (ViewEvent $event, View $view) use ($ui, $dependencies) {
                //     $view->data('$components', new \stdClass());
                //     $view->data('$ui', $ui[Theme::UI_SITE]);
                //     $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $dependencies[Theme::UI_SITE]);
                // },
                // 'view.system/widget/edit' => function (ViewEvent $event, View $view) use ($ui, $dependencies)  {
                //     $view->data('$positions', new \stdClass());
                //     $view->data('$ui', $ui['widget']);
                //     $view->script('widget-layout', 'theme-core:app/bundle/widget-layout.js', ['widget-edit']);
                //     $view->script('widget-position', 'theme-core:app/bundle/widget-position.js', $dependencies['widget']);
                // },
                // 'view.system/site/admin/settings' => function (ViewEvent $event, View $view) use ($themeConfig, $ui, $dependencies) {
                //     $view->data('$themeName', $this->options['name']); // $this refers to Module instance (where callback is executed)
                //     $view->data('$themeConfig', $themeConfig);
                //     $view->data('$components', new \stdClass());
                //     $view->data('$ui', $ui[Theme::UI_SETTINGS]);
                //     $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies[Theme::UI_SETTINGS]);
                // },
            ];

        }

        return $module;
    }
}
