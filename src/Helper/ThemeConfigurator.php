<?php

namespace SAB\Extension\Theme\Helper;

use Pagekit\Module\Module;


class ThemeConfigurator
{
    const Section = [
        'classes' => '',
        'cover' => '',
        'src' => '',
        'container' => '',
        'custom' => ''
    ];

    const Position = [
        'classes' => 'uk-flex-center uk-flex-middle',
        'height' => '',
        'ukHeightViewport' => '',
        'renderAlways' => false,
        'custom' => ''
    ];

    const Widget = [
        'gridItemClasses' => '',
        'containerClasses' => '',
        'heading' => '',
        'htag' => 'h3',
        'hlink' => true,
        'custom' => ''
    ];

    const Navbar = [
        'transparent' => false,
        'expand' => false,
    ];

    /**
     * @param Module $module theme module to configure
     */
    function __construct(Module $module)
    {
        $this->module = $module;
    }

    /**
     * Add theme node option
     *
     * @param string $key
     * @param string|array $value
     * @return void
     */
    public function addNodeOption(string $key, $value)
    {
        $this->module->options['node'][$key] = $value;
    }

    /**
     * Add theme position
     *
     * @param string $name
     * @param string $title
     * @param boolean $addNodeOption register a node option for this position
     * @return void
     */
    public function addPosition(string $name, string $title, bool $addNodeOption = true)
    {
        $this->module->options['positions'][$name] = $title;
        if ($addNodeOption) $this->addNodeOption('Position'.$name, self::Position);
    }

    /**
     * Add a set of positions
     * $name => [$title, $addNodeOption] or $name => $title
     *
     * @param array $positions
     * @return void
     */
    public function addPositions(array $positions)
    {
        foreach ($positions as $name => $value) {
            if (is_string($value)) {
                $this->addPosition($name,$value);
            }
            else if (is_array($value)) {
                $this->addPosition($name, $value[0], $value[1]);
            }
        }
    }

    /**
     * Add a section node option
     *
     * @param string $name
     * @return void
     */
    public function addSectionOption(string $name)
    {
        $this->addNodeOption('Section'.$name, self::Section);
    }

    /**
     * Add a set of section node option
     *
     * @param array $sections
     * @return void
     */
    public function addSectionOptions(array $sections)
    {
        foreach ($sections as $name) {
            $this->addSectionOption($name);
        }
    }

    /**
     * Add widget option
     *
     * @return void
     */
    public function addWidgetOption()
    {
        $this->module->options['widget'] = self::Widget;
    }

    public function addNavbarOption()
    {
        $this->addNodeOption('Navbar', self::Navbar);
    }
}
