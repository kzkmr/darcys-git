<?php
namespace Customize\Twig\Extension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EccubeExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('instagram', [$this, 'instagram']),
        ];
    }

    public function instagram(){
        echo do_shortcode( '[instagram-feed]' );
    }
}