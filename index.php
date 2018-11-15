<?php

use Pagekit\Application as App;
use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Core\Position;
use SAB\Extension\Theme\Core\Wrapper;
use SAB\Extension\Theme\Helper\ThemeHelper;

return [

    'name' => 'theme-core',

    'autoload' => [
        'SAB\\Extension\\Theme\\' => 'src'
    ],

    'main' => function (App $app) {

        $app['tm'] = function () use ($app) {
            return new Theme($app);
        };

        $app['tm']->add([
            new Position (
                'grid',
                'theme-core:app/bundle/position-grid.js',
                'theme-core/position-grid.php',
                [
                    'classes' => '',
                    'custom' => '',
                    'height' => '',
                    'ukHeightViewport' => ''
                ],
                'theme-core:app/bundle/widget-position-grid.js',
                [
                    'classes' => '',
                    'custom' => '',
                    'card' => ThemeHelper::OPTIONS_CARD
                ]
            ),
            new Position (
                'hero',
                'theme-core:app/bundle/position-hero.js',
                'theme-core/position-hero.php',
                [
                    'classes' => '',
                    'src' => '',
                    'type' => '',
                    'custom' => '',
                ],
                'theme-core:app/bundle/widget-position-hero.js',
                [
                    'classes' => '',
                    'custom' => ''
                ]
            ),
            new Wrapper (
                'section',
                'theme-core:app/bundle/section.js',
                'theme-core/section.php',
                [
                    'classes' => '',
                    'src' => '',
                    'container' => '',
                    'custom' => ''
                ]
            )
        ]);

        $app['module']->addLoader($app['tm']);
    },

];
