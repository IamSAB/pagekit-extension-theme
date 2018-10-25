<?php

namespace SAB\Extension\Theme\Core;

use Pagekit\View\Asset\AssetManager;


class GridPosition extends Component
{
    public function scripts(AssetManager $scripts)
    {
        $scripts->register('position-grid', 'theme-core:app/bundle/position-grid.js');
        $scripts->register('position-grid-item', 'theme-core:app/bundle/position-grid-item.js');
    }

    public function theme(array &$module)
    {
        foreach($this->elements as $name => $element) {
            $module['positions'][$name] = uc_first($name);
        }

        $module['node']['position-grid'] = [
            //position grid config
        ];

        $module['widget']['position-grid-item'] = [
            //position grid item config
        ];
    }

    public function ui(array &$node, array &$settings)
    {
        foreach ($this->elements as $name => $element) {
            $node[] = [
                'component' => 'position-grid',
                'name' => uc_first($element)
            ];
        }
    }

    public function dependecies(array &$node, array &$widget, array &$settings);
}