<?php

use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Helper\ThemeHelper;

return [

    'name' => 'theme-core',

    'autoload' => [
        'SAB\\Extension\\Theme\\' => 'src'
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
