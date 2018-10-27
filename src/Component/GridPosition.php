<?php

namespace SAB\Extension\Theme\Component;

use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Core\PositionInterface;
use SAB\Extension\Theme\Core\ItemInterface;
use Pagekit\Application;


class GridPosition extends Component implements PositionInterface
{
    public function render($position)
    {
        $options = $this->get($position)->getOptions();
        $options['component'] = $position;
        return Application::view()->position($position, 'theme-core/position-grid.php', $options);
    }

    public static function getDefaultOptions()
    {
        return [
            'classes' => '',
            'custom' => '',
            'height' => '',
            'ukHeightViewport' => ''
        ];
    }

    public static function getScript()
    {
        return 'theme-core:app/bundle/position-grid.js';
    }

    public static function getUi()
    {
        return Theme::UI_SITE;
    }

    public static function getWidgetScript()
    {
        return 'theme-core:app/bundle/widget-position-grid.js';
    }

    public static function getWidgetDefaultOptions()
    {
        return [
            'classes' => '',
            'custom' => ''
        ];
    }

    public static function editableDefaultOptions()
    {
        return true;
    }

    public function getName()
    {
        return 'grid';
    }
}
