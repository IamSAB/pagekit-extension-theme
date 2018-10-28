<?php

namespace SAB\Extension\Theme\Component;

use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Core\PositionInterface;
use SAB\Extension\Theme\Core\ItemInterface;
use Pagekit\Application;


class HeroPosition extends Component implements PositionInterface
{
    public function render($position)
    {
        $options = $this->get($position)->getOptions();
        $options['component'] = $position;
        return $this->view->position($position, 'theme-core/position-hero.php', $options);
    }

    public static function getDefaultOptions()
    {
        return [
            'classes' => '',
            'src' => '',
            'type' => '',
            'custom' => '',
        ];
    }

    public static function getScript()
    {
        return 'theme-core:app/bundle/position-hero.js';
    }

    public static function getUi()
    {
        return Theme::UI_SITE;
    }

    public static function getWidgetScript()
    {
        return 'theme-core:app/bundle/widget-position-hero.js';
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
        return 'hero';
    }
}
