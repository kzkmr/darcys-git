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

namespace Plugin\CustomerGroup\Service\PurchaseFlow;


use Eccube\Annotation\CartFlow;
use Eccube\Annotation\ShoppingFlow;
use Eccube\Entity\ItemInterface;
use Eccube\Service\PurchaseFlow\ItemValidator;
use Eccube\Service\PurchaseFlow\PurchaseContext;
use Plugin\CustomerGroup\Security\Authorization\Voter\ProductVoter;
use Symfony\Component\Security\Core\Security;

/**
 * Class GroupValidator
 * @package Plugin\CustomerGroup\Service\PurchaseFlow
 *
 * @CartFlow()
 * @ShoppingFlow()
 */
class GroupValidator extends ItemValidator
{
    /**
     * @var Security
     */
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function validate(ItemInterface $item, PurchaseContext $context)
    {
        if (false === $item->isProduct()) {
            return;
        }

        $product = $item->getProductClass()->getProduct();
        if (false === $this->security->isGranted(ProductVoter::CART, $product)) {
            $this->throwInvalidItemException('customer_group.front.cart.error', $item->getProductClass());
        }
    }

    protected function handle(ItemInterface $item, PurchaseContext $context)
    {
        $item->setQuantity(0);
    }
}
