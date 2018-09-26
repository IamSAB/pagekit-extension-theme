<?php

use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Helper\ThemeHelper;
use Pagekit\Application as App;

return [

    'name' => 'theme-core',

    'autoload' => [
        'SAB\\Extension\\Theme\\' => 'src'
    ],

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
