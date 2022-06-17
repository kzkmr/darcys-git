<?php
namespace Plugin\Webapi\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="news_rss")
 * @ORM\Entity(repositoryClass="Plugin\Webapi\Repository\NewsRepository")
 */
class News
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="feature_image", type="string", length=255, nullable=true)
     */
    private $feature_image;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", nullable=true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", nullable=true)
     */
    private $category;


    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="create_at", type="datetimetz", nullable=true)
     */
    private $create_at;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUrl(){
        return $this->url;
    }

    /**
     * @return string
     */
    public function getFeatureImage(){
        return $this->feature_image;
    }

    /**
     * @return string
     */
    public function getSource(){
        return $this->source;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreateAt(){
        return $this->create_at;
    }

    /**
     * @return string
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * @param string $title
     * @return self
     */
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url){
        $this->url = $url;
        return $this;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description){
        $this->description = $description;
        return $this;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setFeatureImage($image){
        $this->feature_image = $image;
        return $this;
    }

    /**
     * @param \DateTime|null $date
     * @return $this
     */
    public function setCreateAt($date = null){
        $this->create_at = $date;
        return $this;
    }

    /**
     * @param $source
     * @return $this
     */
    public function setSource($source){
        $this->source = $source;
        return $this;
    }

    /**
     * @param $category
     * @return $this
     */
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }
}
