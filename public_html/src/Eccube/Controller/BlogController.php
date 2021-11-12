<?php namespace Eccube\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        define( 'WP_USE_THEMES', true );
        require __DIR__ . '/../../../blog/wp-blog-header.php';
        return;
    }
}
