<?php

namespace SAB\Extension\Theme\Loader;

use Pagekit\Module\Loader\LoaderInterface;
use Pagekit\Application;
use SAB\Extension\Theme\Element\MenuInterface;
use SAB\Extension\Theme\Element\PositonInterface;
use SAB\Extension\Theme\Element\DefaultInterface;
use SAB\Extension\Theme\Component\Widget;
use SAB\Extension\Theme\Component\Position;


class ThemeLoader implements LoaderInterface
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function load($module)
    {
        $app = $this->app;

        if ($module['type'] == 'theme' && $module['require'] == 'theme-core') {

            $app['elements']->add($module['elements']);

            $app->on('view.system/site/admin/edit', function ($view,$event) use ($app) {
                $view->data('$components', new \stdClass());
                $view->data('$elements', $app['elements']);
                $dependencies = ['site-edit'];
                foreach ($app['elements'] as $element) {

                }
                $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies);
            });


            // widget-edit
            $app->on('view.system/site/widget/edit', function ($view,$event) use ($app) {
                $view->data('$scripts', new \stdClass());
                $dependencies = ['widget-edit'];
                $components = [];
                foreach($app['components'] as $component) {
                    if ($component instanceof Widget) {
                        $dependencies[] = $component->getComponent();
                    }
                    else if ($component instanceof Position) {

                    }
                }
                $view->data('$position', $components);
                $view->data('$layout', $components);
                $view->script('widget-theme', 'theme-core:app/bundle/site-theme.js', $dependencies);
            });

            $app->on('view.system/site/admin/settings', function ($view,$event) use ($app, $dependencies) {
                $view->data('$components', new \stdClass());
                $view->data('$elements', $app['elements']);
                $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $dependencies);
            });
        }
    }
}
