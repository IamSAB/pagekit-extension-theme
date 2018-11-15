<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\View\Helper\Helper;
use Pagekit\Site\Model\Node;
use SAB\Extension\Theme\Theme;
use Pagekit\Widget\Model\Widget;
use Pagekit\Application;
use Pagekit\View\View;


class ThemeHelper extends Helper
{
    protected $widget = null;

    /**
     * Constructor
     *
     * @param Theme $tm
     */
    function __construct(Theme $tm)
    {
        $this->tm = $tm;
    }

    public function register(View $view)
    {
        $this->view = $view;
        foreach ($this->tm as $comName => $component) {
            $component->register($view);
        }
    }

    const OPTIONS_HEADING = [
        'style' => '',
        'tag' => 'h1',
        'link' => false
    ];

    public function heading(string $title, array $options = [], string $default = '')
    {
        $options = array_replace(self::OPTIONS_HEADING, $options);
        $options['title'] = $title;
        $options['default'] = $default;
        return $this->view->render('theme-core/heading.php', $options);
    }

    const OPTIONS_CARD = [
        'classes' => 'uk-card-default',
        'header' => '',
        'footer' => ''
    ];

    public function card(string $heading, string $content, array $options = [])
    {
        $options = array_replace(self::OPTIONS_CARD, $options);
        $options['heading'] = $heading;
        $options['content'] = $content;
        return $this->view->render('theme-core/card.php', $options);
    }

    function __invoke(string $component)
    {
        return $this->tm->get($component);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return "tm";
    }

}
