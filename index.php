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

        $app['tm'] = function () {
            return new Theme($app);
        };

        $grid = new Component('grid', [
            'classes' => 'uk-flex-center uk-flex-middle',
            'height' => '',
            'ukHeightViewport' => '',
            'custom' => ''
        ],
        'theme-core:app/bundle/position-grid.js',
        function ($view, $collection, $element) {
            return $view->render('theme-core/position-grid.js', $view->params[$collection->getName()]);
        }, function () {

        });

        $position = new Collection('position');
        $widgetPosition = new Collection('widget-position', Collection::VIEW_WIDGET);
        $widgetLayout = new Collection('widget-layout', Collection::VIEW_WIDGET, Collection::MODE_SWITCH);

        $app['tm']->add($position);
        $app['tm']->add($widgetLayout);
        $app['tm']->add($widgetPosition);

        $app['module']->addLoader($app['tm']);
    },

    'components' => [
        'grid' => [
            'args' => ['content'],
            'options' => [
                'classes' => 'uk-flex-center uk-flex-middle',
                'height' => '',
                'ukHeightViewport' => '',
                'renderAlways' => false,
                'custom' => ''
            ],
            'editable' => true,
            'php' => 'theme-core:views/grid.php',
            'js' => 'theme-core:app/bundle/settings/grid.js'
        ],
        'widget' => [
            'args' => [],
            'options' => [
                'layout' => 'card',
                'classes' => '',
                'custom' => ''
            ]
        ],
        'segment' => [
            'args' => ['content'],
            'options' => [
                'classes' => '',
                'cover' => '',
                'src' => '',
                'container' => '',
                'custom' => ''
            ],
            'editable' => true,
            'php' => 'theme-core:views/segment.php',
            'js' => 'theme-core:app/bundle/settings/segment.js'
        ],
        'heading' => [
            'args' => ['title'],
            'options' => [
                'heading' => '',
                'tag' => 'h3',
                'link' => true,
            ]
        ],
        'navbar' => [
            'args' => ['content'],
            'options' => [
                'transparent' => false,
                'expand' => false,
            ]
        ],
        'nav' => [
            'options' => [
                'classes' => '',
            ]
        ],
        'navbarnav' => [
            'options' => [
                'classes' => '',
            ],
            'php' => 'theme-core:views/navbarnav.php',
            'js' => 'theme-core:app/bundle/settings/navbarnav.js'
        ],
        'subnav' => [
            'options' => [
                'classes' => '',
            ]
        ],
        'card' => [
            'options' => [
                'classes' => '',
            ]
        ],
        'tile' => [
            'options' => [
                'classes' => '',
            ]
        ],
        'sidebar' => [
            'options' => [
                'classes' => '',
            ]
        ]
    ]
];
