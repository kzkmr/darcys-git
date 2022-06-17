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
use Eccube\Repository\ProductRepository;
use Eccube\Repository\QueryKey;
use Plugin\CustomerGroup\Traits\ConfigTrait;
use Symfony\Component\Security\Core\Security;

class ProductSearchCustomizer implements QueryCustomizer
{
    use ConfigTrait;

    /**
     * @var Security
     */
    protected $security;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    public function __construct(
        Security $security,
        ProductRepository $productRepository
    )
    {
        $this->security = $security;
        $this->productRepository = $productRepository;
    }

    public function customize(QueryBuilder $builder, $params, $queryKey): void
    {
        if (false === $this->getConfig()->isOptionGroupProductHidden()) {
            return;
        }

        $subQuery = $this->productRepository->createQueryBuilder('sub')
            ->select('DISTINCT(sub.id)')
            ->innerJoin('sub.groups', 'g');

        $user = $this->security->getUser();
        if ($user instanceof Customer) {
            if ($user->hasGroups()) {
                // ユーザーに登録されているグループを除く、グループに所属している商品を取得
                $subQuery->where($subQuery->expr()->notIn('g.id', ':groups'));

                // ユーザーに登録されている商品は除く
                $exclude = $user->getGroupProducts();
                if ($exclude->count() > 0) {
                    $subQuery->andWhere($subQuery->expr()->notIn('sub.id', ':exclude'));
                }

                // 会員に登録されていないグループに所属している商品を除外
                $builder
                    ->andWhere($builder->expr()->notIn('p.id', $subQuery->getDQL()))
                    ->setParameter('groups', $user->getGroups());

                if ($exclude->count() > 0) {
                    $builder->setParameter('exclude', $exclude);
                }

                return;
            }
        }

        // グループに所属している商品を除外
        $builder->andWhere($builder->expr()->notIn('p.id', $subQuery->getDQL()));
    }

    public function getQueryKey(): string
    {
        return QueryKey::PRODUCT_SEARCH;
    }
}
