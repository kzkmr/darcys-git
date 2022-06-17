<?php

namespace Plugin\Webapi\Repository;

use Eccube\Repository\AbstractRepository;
use Plugin\Webapi\Entity\News;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * ConfigRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsRepository extends AbstractRepository
{
    /**
     * ConfigRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, News::class);
    }

    /**
     * @param int $id
     *
     * @return null|Config
     */
    public function get($id = 1)
    {
        return $this->find($id);
    }
}
