<?php

namespace SAB\Penta;

use Pagekit\Module\Module;
use Pagekit\Application;


class Theme extends Module
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

    public function main(Application $app)
    {

        $this->options['widget'] = [
            'gridItemClasses' => '',
            'containerClasses' => '',
            'heading' => '',
            'htag' => 'h3',
            'hlink' => true,
            'custom' => ''
        ];

        $this->options['node'] = [
            'Navbar' => [
                'transparent' => false,
                'expand' => false
            ],
            'Content' => [
                'heading' => '',
                'classes' => ''
            ],
            'SectionTopA' => self::Section,
            'SectionTopB' => self::Section,
            'SectionMain' => self::Section,
            'SectionBottomA' => self::Section,
            'SectionBottomB' => self::Section,
            'SectionFoot' => self::Section,
            'PositionTopA' => self::Position,
            'PositionTopB' => self::Position,
            'PositionMainTop' => self::Position,
            'PositionMainBottom' => self::Position,
            'PositionBottomA' => self::Position,
            'PositionBottomB' => self::Position,
            'PositionFoot' => self::Position
        ];
    }
}
