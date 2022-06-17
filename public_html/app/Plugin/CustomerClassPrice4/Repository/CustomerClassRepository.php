<?php
/**
 * This file is part of CustomerClassPrice4
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerClassPrice4\Repository;

use Plugin\CustomerClassPrice4\Entity\CustomerClass;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Eccube\Repository\AbstractRepository;

/**
 * @method CustomerClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerClass[]    findAll()
 * @method CustomerClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerClassRepository extends AbstractRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerClass::class);
    }

    // /**
    //  * @return CustomerClass[] Returns an array of CustomerClass objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CustomerClass
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
