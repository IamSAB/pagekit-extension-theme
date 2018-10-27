<?php

namespace SAB\Extension\Theme\Component;

use SAB\Extension\Theme\Core\Component;
use SAB\Extension\Theme\Theme;
use SAB\Extension\Theme\Core\ItemInterface;
use Pagekit\Application;


class Section extends Component implements ItemInterface
{
    protected $started = false;

    public function start()
    {
        ob_start();
        $this->started = true;
    }

    public function end($element)
    {
        if (!$this->started) {
            throw new \LogicException('No section started');
        }
        if (is_string($element)) {
            $options = $this->elements->get($element)->getOptions();
        }
        else {
            $options = array_merge($element, $this->getDefaultOptions());
        }
        $options['content'] = ob_get_clean();
        return Application::view()->render('theme-core/section.php', $options);
    }

    public function getDefaultOptions()
    {
        return [
            'classes' => '',
            'custom' => ''
        ];
    }

    public function getScript()
    {
        return 'theme-core:app/bundle/section.js';
    }

    public function getUi()
    {
        return Theme::UI_SITE;
    }

    public function getName()
    {
        return 'section';
    }
}
