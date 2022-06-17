<?php
/**
 * This file is part of CustomerGroup
 *
 * Copyright(c) Akira Kurozumi <info@a-zumi.net>
 *
 * https://a-zumi.net
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Plugin\CustomerGroup\Tests\Repository;


use Doctrine\Common\Collections\ArrayCollection;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Repository\GroupRepository;
use Plugin\CustomerGroup\Tests\TestCaseTrait;

class GroupRepositoryTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var array
     */
    protected $Results;

    /**
     * @var array
     */
    protected $searchData = [];

    /**
     * @var GroupRepository
     */
    protected $groupRepository;

    /**
     * @var \Plugin\CustomerGroup\Entity\Group
     */
    protected $group;

    public function setUp()
    {
        parent::setUp();

        $this->groupRepository = self::$container->get(GroupRepository::class);
    }

    public function scenario()
    {
        $this->Results = $this->groupRepository->getQueryBuilderBySearchData($this->searchData)
            ->getQuery()
            ->getResult();
    }

    public function test会員グループの順序確認()
    {
        $group1 = $this->createGroup();
        $group2 = $this->createGroup();

        $this->scenario();
        $groups = new ArrayCollection($this->Results);

        self::assertCount(2, $groups);

        $this->expected = $group1->getId();
        $this->actual = $groups->first()->getId();
        $this->verify();
    }
}
