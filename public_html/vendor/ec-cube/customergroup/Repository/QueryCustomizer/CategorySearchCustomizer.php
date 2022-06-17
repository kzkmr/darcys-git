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

namespace Plugin\CustomerGroup\Repository\QueryCustomizer;


use Doctrine\ORM\QueryBuilder;
use Eccube\Doctrine\Query\QueryCustomizer;
use Eccube\Entity\Customer;
use Plugin\CustomerGroup\Repository\CategoryRepository;
use Plugin\CustomerGroup\Repository\QueryKey;
use Plugin\CustomerGroup\Traits\ConfigTrait;
use Symfony\Component\Security\Core\Security;

class CategorySearchCustomizer implements QueryCustomizer
{
    use ConfigTrait;

    /**
     * @var Security
     */
    protected $security;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(
        Security $security,
        CategoryRepository $categoryRepository
    )
    {
        $this->security = $security;
        $this->categoryRepository = $categoryRepository;
    }

    public function customize(QueryBuilder $builder, $params, $queryKey)
    {
        if (false === $this->getConfig()->isOptionGroupCategoryHidden()) {
            return;
        }

        $subQuery = $this->categoryRepository->createQueryBuilder('sub')
            ->select('DISTINCT(sub.id)')
            ->innerJoin('sub.groups', 'g');

        $user = $this->security->getUser();
        if ($user instanceof Customer) {
            if ($user->hasGroups()) {
                // ユーザーに登録されているグループを除く、グループに所属しているカテゴリを取得
                $subQuery->where($builder->expr()->notIn('g.id', ':groups'));

                // ユーザーに登録されているカテゴリは除く
                $exclude = $user->getGroupCategories();
                if ($exclude->count() > 0) {
                    $subQuery->andWhere($builder->expr()->notIn('c1.id', ':exclude'));
                }

                // 会員に登録されていないグループに所属しているカテゴリを除外
                $builder
                    ->andWhere($builder->expr()->notIn('c1.id', $subQuery->getDQL()))
                    ->setParameter('groups', $user->getGroups());

                if ($exclude->count() > 0) {
                    $builder->setParameter('exclude', $exclude);
                }

                return;
            }
        }

        // グループに所属している商品を除外
        $builder->andWhere($builder->expr()->notIn('c1.id', $subQuery->getDQL()));
    }

    public function getQueryKey()
    {
        return QueryKey::CATEGORY_SEARCH;
    }
}
