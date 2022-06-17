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

namespace Plugin\CustomerGroup\Tests\Twig\Extension;


use Eccube\Entity\Category;
use Eccube\Tests\EccubeTestCase;
use Plugin\CustomerGroup\Tests\TestCaseTrait;
use Plugin\CustomerGroup\Twig\Extension\GroupExtension;
use Symfony\Component\Security\Core\Authentication\Token\AnonymousToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class GroupExtensionTest extends EccubeTestCase
{
    use TestCaseTrait;

    /**
     * @var GroupExtension
     */
    protected $extension;

    /**
     * @var TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var array
     */
    protected $Results;

    public function setUp()
    {
        parent::setUp();

        $this->extension = self::$container->get(GroupExtension::class);
        $this->tokenStorage = self::$container->get('security.token_storage');

        $this->enableOptionCategoryHidden();
    }

    public function scenario()
    {
        $this->Results = $this->extension->getGroupCategories();
    }

    public function testGetGroupCategories()
    {
        $token = $this->createMock(AnonymousToken::class);
        $this->tokenStorage->setToken($token);

        $group = $this->createGroup();

        /** @var Category $category */
        $category = $this->entityManager->getRepository(Category::class)->find(1);
        $category->addGroup($group);
        $group->addCategory($category);
        $this->entityManager->flush();

        $this->scenario();

        $this->expected = 2;
        $this->actual = count($this->Results);
        $this->verify();
    }
}
