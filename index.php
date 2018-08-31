<?php

use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Helper\ThemeHelper;

return [

    'name' => 'theme-core',

    'menus' => [
        'main' => 'Main',
        'footer' => 'Footer'
    ],

    'autoload' => [
        'SAB\\Extension\\Theme\\' => 'src'
    ],

    'main' => 'SAB\\Extension\\Theme\\ThemeModule',


    'positions' => [
        'hero' => 'Hero',
        'TopA' => 'Top A',
        'TopB' => 'Top B',
        'Sidebar' => 'Sidebar',
        'MainTop' => 'Main Top',
        'MainBottom' => 'Main Bottom',
        'BottomA' => 'Bottom A',
        'BottomB' => 'Bottom B',
        'Foot' => 'Footer'
    ],

    'config' => [
        'logo_inverse' => '',
        'css' => ''
    ],

    'events' => [

        'view.init' => function ($event, $view) use ($app) {
            $view->addHelper(new ThemeHelper());
        },

        'view.system/site/admin/settings' => function ($event, $view) use ($app) {
            $view->script('site-setting-theme', 'theme:app/bundle/SiteSettingTheme.js', 'site-settings');
            $view->data('$theme', $this);
        },

        'view.system/site/admin/edit' => function ($event, $view) {
            $view->script('site-node-theme', 'theme:app/bundle/SiteNodeTheme.js', 'site-edit');
        },

        'view.system/widget/edit' => function ($event, $view) {
            $view->script('site-widget-theme', 'theme:app/bundle/SiteWidgetTheme.js', 'widget-edit');
        }

    ],

    'resources' => [
        'theme-core:views' => 'views'
    ],

];
