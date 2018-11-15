<?php

namespace SAB\Extension\Theme\Core;


class Wrapper extends Component
{
    protected $started = 0;

    public function start()
    {
        ob_start();
        ob_implicit_flush(0);
        $this->started++;
    }

    public function render(string $wrapper)
    {
        if (!$this->started) {
            throw new \LogicException('No wrap started.');
        }
        $this->started--;
        $options = $this->getOptions($wrapper);
        $options['content'] = ob_get_clean();
        return $this->view->render($this->template, $options);
    }
}
