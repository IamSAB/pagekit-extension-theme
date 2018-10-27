<?php

use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Helper\ThemeHelper;
use Pagekit\Application as App;
use SAB\Extension\Theme\ThemeManager;
use SAB\Extension\Theme\Core\Collection;
use SAB\Extension\Theme\Core\Component;

return [

    'name' => 'theme-core',

    'autoload' => [
        'SAB\\Extension\\Theme\\' => 'src'
    ],

    'main' => function ($app) {

        $app['tm'] = function () use ($app) {
            return new Theme($app);
        };

        $app['module']->addLoader($app['tm']);
    }

];
