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

namespace Plugin\CustomerGroup\Twig\Extension;


use Eccube\Common\EccubeConfig;
use Plugin\CustomerGroup\Repository\CategoryRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class GroupExtension extends AbstractExtension
{
    /**
     * @var EccubeConfig
     */
    private $eccubeConfig;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        EccubeConfig $eccubeConfig,
        CategoryRepository $categoryRepository
    )
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->categoryRepository = $categoryRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('group_categories', [$this, 'getGroupCategories'])
        ];
    }

    public function getGroupCategories()
    {
        $qb = $this->categoryRepository->getQueryBuilderBySearchData(['parent' => null]);
        return $qb
            ->getQuery()
            ->enableResultCache($this->eccubeConfig['eccube_result_cache_lifetime'])
            ->getResult();
    }
}
