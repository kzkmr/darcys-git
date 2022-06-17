<?php namespace Eccube\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/shop", name="shop")
     */
    public function index()
    {
        define( 'WP_USE_THEMES', true );
        require __DIR__ . '/../../../shop/wp-blog-header.php';
        return;
    }
}
