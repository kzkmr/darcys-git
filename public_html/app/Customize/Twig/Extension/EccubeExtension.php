<?php
namespace Customize\Twig\Extension;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class EccubeExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('instagram', [$this, 'getFeed']),
        ];
    }

    public function getFeed() {
        echo do_shortcode( '[instagram-feed]' );
    }
}