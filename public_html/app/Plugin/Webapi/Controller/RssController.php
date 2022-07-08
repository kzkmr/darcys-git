<?php

/**
 * Class ResetPassController
 * @package Plugin\Webapi\Controller
 * @author Tyler Nguyen <tylermagento@gmail.com>
 * @created : 13/03/2022
 */

namespace Plugin\Webapi\Controller;

use Eccube\Application;
use Plugin\Webapi\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sunra\PhpSimple\HtmlDomParser;
use Plugin\Webapi\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class RssController extends AbstractController
{

    private $newRepository;

    private $entityManager;

    public function __construct(NewsRepository  $newRepository, EntityManagerInterface $entityManager)
    {
        $this->newRepository = $newRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/rss", name="rss_generate")
     * @Method("GET")
     */
    public function rss(Request $request)
    {
    	$url = $request->get('url');
        $category = $request->get('category');
    	$xmlContent = file_get_contents($url);

    	$xml = simplexml_load_string($xmlContent) or die("Error: Cannot create object");
    	$newxml = new \SimpleXMLElement('<rss version="2.0"><channel></channel></rss>');
        $newxml->channel->language = $xml->channel->language;
        $newxml->channel->copyright = $xml->channel->copyright;
        $newxml->channel->pubDate = $xml->channel->pubDate;
        $newxml->channel->title = $xml->channel->title;
        $newxml->channel->link = $xml->channel->link;
        $newxml->channel->description = $xml->channel->description;

    	for($i=0;$i<count($xml->channel->item);$i++){
    		$item = $xml->channel->item[$i];
    		$itemLink = $item->link;
    		$itemLink = (array) $itemLink;
            $checkExist = $this->newRepository->findOneBy(['url'=>$itemLink[0]]);
            if(!$checkExist && isset($itemLink[0])) :
                $dom = HtmlDomParser::file_get_html($itemLink[0]);
                $article_picture = $dom->find('main#contents',0)->find('article',0)->find('picture',0);
                $picture = '';
                if($article_picture){
                    $picture  = $article_picture->find('img',0)->src;
                }
                $new = new News();
                $new->setTitle($item->title);
                $new->setDescription(($item->description[0])?$item->description[0]:' ');
                $new->setUrl($itemLink[0]);
                $new->setFeatureImage($picture);
                $new->setSource('yahoo');
                $new->setCategory($category);
                $new->setCreateAt(new \DateTime('now'));
                $this->entityManager->persist($new);
                $this->entityManager->flush();
            endif;
    	}
        $latestFivety = $this->newRepository->findBy(['category'=>$category],null,50,0);
        foreach ($latestFivety as $item){
            $itemXML = $newxml->channel->addChild('item');
            $itemXML->addChild('title', $item->getTitle());
            $itemXML->addChild('link', $item->getUrl());
            $itemXML->addChild('pubDate', $item->getCreateAt()->format('d-m-Y'));
            $itemXML->addChild('description', htmlspecialchars($item->getDescription()));
            $itemXML->addChild('author', $item->getFeatureImage());
        }
    	$response = new Response($newxml->asXML());
      	$response->headers->set('Content-Type', 'application/xml');

      	return $response;
    }

    /**
     * @Route("/rss_darcy", name="rss_darcy_generate")
     * @Method("GET")
     */
    public function rss_darcy(Request $request)
    {
        $url = 'https://darcys.jp/?xml';
        $xmlContent = file_get_contents($url);

        $xml = simplexml_load_string($xmlContent) or die("Error: Cannot create object");
        $newxml = new \SimpleXMLElement($xmlContent);
        for($i=0;$i<count($xml->item);$i++){
            $item = $xml->item[$i];
            $itemLink = $item->link;
            $itemLink = (array) $itemLink;

            $dom = HtmlDomParser::file_get_html($itemLink[0]);
            // $article_picture = $dom->find('main#contents',0)->find('article',0)->find('picture',0);
            // if($article_picture){
            //     $picture  = $article_picture->find('img',0)->src;
            //     $newxml->channel->item[$i]->addChild('author',$picture);
            // }
            $ogimage = $dom->find('meta[property="og:image"]',0);

            if($ogimage){
                $newxml->item[$i]->addChild('author',$ogimage->content);
            }
        }

        $response = new Response($newxml->asXML());
        $response->headers->set('Content-Type', 'application/xml');

        return $response;
    }
}
