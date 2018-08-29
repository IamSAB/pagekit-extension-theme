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

        $this->options['node'] = [
            'Navbar' => [
                'transparent' => false,
                'expand' => false
            ],
            'Content' => [
                'heading' => '',
                'classes' => ''
            ],
            'SectionHero' => self::Section,
            'PositionHero' => self::Position,
            'SectionTopA' => self::Section,
            'SectionTopB' => self::Section,
            'SectionTopC' => self::Section,
            'SectionTopD' => self::Section,
            'SectionMain' => self::Section,
            'SectionBottomA' => self::Section,
            'SectionBottomB' => self::Section,
            'SectionBottomC' => self::Section,
            'SectionBottomD' => self::Section,
            'SectionFoot' => self::Section,
            'PositionTopA' => self::Position,
            'PositionTopB' => self::Position,
            'PositionTopC' => self::Position,
            'PositionTopD' => self::Position,
            'PositionMainTop' => self::Position,
            'PositionMainBottom' => self::Position,
            'PositionBottomA' => self::Position,
            'PositionBottomB' => self::Position,
            'PositionBottomC' => self::Position,
            'PositionBottomD' => self::Position,
            'PositionFoot' => self::Position
        ];
    }
}
