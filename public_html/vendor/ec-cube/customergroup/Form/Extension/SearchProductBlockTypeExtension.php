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

namespace Plugin\CustomerGroup\Form\Extension;


use Eccube\Common\EccubeConfig;
use Eccube\Entity\Category;
use Eccube\Form\Type\SearchProductBlockType;
use Plugin\CustomerGroup\Repository\CategoryRepository;
use Plugin\CustomerGroup\Traits\ConfigTrait;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class SearchProductBlockTypeExtension extends AbstractTypeExtension
{
    use ConfigTrait;

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

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $qb = $this->categoryRepository->getQueryBuilderBySearchData(['parent' => null]);
        $categories = $qb
            ->getQuery()
            ->enableResultCache($this->eccubeConfig['eccube_result_cache_lifetime'])
            ->getResult();

        $array = [];
        /** @var Category $category */
        foreach ($categories as $category) {
            $array = array_merge($array, $category->getSelfAndDescendants());
        }
        $categories = $array;

        if ($categories) {
            $builder->add('category_id', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'NameWithLevel',
                'choices' => $categories,
                'placeholder' => 'common.select__all_products',
                'required' => false,
            ]);
        }
    }

    /**
     * @return string
     */
    public function getExtendedType(): string
    {
        return SearchProductBlockType::class;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        yield SearchProductBlockType::class;
    }
}
