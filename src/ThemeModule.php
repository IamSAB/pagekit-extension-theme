<?php

namespace SAB\Extension\Theme;

use Pagekit\Application as App;
use Pagekit\View\Event\ViewEvent;
use Pagekit\Util\Arr;
use Pagekit\Log\Logger;
use Pagekit\Module\Module;
use SAB\Extension\Theme\Helper\ThemeHelper;


class ThemeModule extends Module
{
    protected $components = [];
    protected $methods = [];
    protected $settings = [];
    protected $scripts = [];

    function __construct(array $options)
    {
        $this->name = $options['name'];
        $this->path = $options['path'];
        $this->options = $options;

        if (isset($options['components'])) {
            $options['components'] = array_merge_recursive(App::module('theme-core')->get('components'), $options['components']);
        }
        else {
            $options['components'] = App::module('theme-core')->get('components');
        }

        foreach ($options['components'] as $component => $config)
        {
            $config = array_replace([
                'args' => [],
                'options' => [],
                'editable' => false,
                'php' => '',
                'js' => ''
            ], $config);

            $this->components[$component] = $config;

            if ($config['editable']) {
                $this->components[$component]['options'] = App::config($this->name)->get("$component.default", $config['options']);
                $this->load('config', $component, 'default', [
                    'title' => ucfirst($component),
                    'path' => 'defaults'
                ]);
            }
        }

        foreach ($options['theme'] as $type => $arr) {
            foreach ($arr as $component => $subarr) {
                foreach ($subarr as $name => $config) {
                    if ($type == 'positions') {
                        $this->options['positions'][$name] = $config['title'];
                        $type = 'node';
                    }
                    elseif ($type == 'menus') {
                        $this->options['menus'][$name] = $config['title'];
                        $type = 'node';
                    }
                    $this->load($type, $component, $name, $config);
                }
            }
        };

        $this->options['events'] = [
            'view.init' => function ($event, $view) {
                $view->addHelper(new ThemeHelper($this->methods));
            },
            'view.system/site/admin/edit' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$settings', $this->settings['node']);
                $last = 'site-edit';
                foreach($this->scripts['node'] as $name => $resource) {
                    $view->script($name, $resource, $last);
                    $last = $name;
                };
                $view->script('node-theme', 'theme-core:app/bundle/node-theme.js', $last);
            },
            'view.system/widget/edit' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$settings', $this->settings['widget']);
                $last = 'widget-edit';
                foreach($this->scripts['widget'] as $name => $resource) {
                    $view->script($name, $resource, $last);
                    $last = $name;
                };
                $view->script('widget-theme', 'theme-core:app/bundle/widget-theme.js', $last);
            },
            'view.system/site/admin/settings' => function ($event, $view) {
                $view->data('$components', new \stdClass());
                $view->data('$theme', $this->config('config'));
                $view->data('$settings', $this->settings['config']);
                $last = 'site-settings';
                foreach($this->scripts['config'] as $name => $resource) {
                    $view->script($name, $resource, $last);
                    $last = $name;
                };
                $view->script('site-theme', 'theme-core:app/bundle/site-theme.js', $last);
            }
        ];

        $this->config = $this->options['config'];

        $this->debug('Loaded theme options: '.json_encode(Arr::extract($this->options,['node', 'widget', 'config'])));
        $this->debug('Loaded methods: '.json_encode($this->methods));
        $this->debug('Loaded settings: '.json_encode($this->settings));
        $this->debug('Loaded scripts: '.json_encode($this->scripts));
        $this->debug('Loaded components: '.json_encode($this->components));
    }

    protected function load(string $type, string $component, string $name, array $settingConfig)
    {
        $this->debug("Load $type / $component / $name");

        $settingConfig = array_replace([
            'title' => ucfirst($name),
            'path' => '',
            'for' => []
        ], $settingConfig);

        if (!isset($this->components[$component])) {
            throw new \InvalidArgumentException("Cannot load setting '$name' from undefined component '$component.");
        }

        $componentConfig = $this->components[$component];

        // add method for helper
        if (!Arr::has($this->methods, "$component.$name")) {
            Arr::set($this->methods, "$component.$name", [
                'args' => $componentConfig['args'],
                'php' => $componentConfig['php']
            ]);
        }

        // add theme config for ui and helper
        Arr::set($this->options, "$type.$component.$name", $componentConfig['options']);

        // add setting for ui
        $settingConfig['component'] = $component;
        $settingConfig['name'] = $name;
        $this->settings[$type][] = $settingConfig;

        // add scripts for ui
        if (!Arr::has($this->scripts, "$type.setting-$component")) {
            if (!$componentConfig['js']) {
                $this->debug("Undefinded script for component '$component'");
            }
            else {
                Arr::set($this->scripts, "$type.setting-$component", $componentConfig['js']);
            }
        }
    }

    protected function debug(string $msg, array $context = [])
    {
        if (App::debug()) { // check if debug mode is enabled
            App::log()->debug($msg, $context);
        }
    }
}