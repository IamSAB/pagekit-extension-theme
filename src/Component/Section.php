<?php

namespace SAB\Extension\Theme\Component;

use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Core\ItemInterface;
use Pagekit\Application;


class Section extends Component
{
    protected $started = false;

    public function start()
    {
        ob_start();
        ob_implicit_flush(0);
        $this->started = true;
    }

    public function end($element)
    {
        if (!$this->started) {
            throw new \LogicException('No section started');
        }
        if (is_string($element)) {
            $options = $this->get($element)->getOptions();
        }
        else {
            $options = array_merge($element, $this->getDefaultOptions());
        }
        $options['content'] = ob_get_clean();
        return $this->view->render('theme-core/section.php', $options);
    }

    public static function getDefaultOptions()
    {
        return [
            'classes' => '',
            'src' => '',
            'container' => '',
            'custom' => ''
        ];
    }

    public static function getScript()
    {
        return 'theme-core:app/bundle/section.js';
    }

    public static function getUi()
    {
        return Theme::UI_SITE;
    }

    public function getName()
    {
        return 'section';
    }
}
