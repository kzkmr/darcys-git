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

namespace Plugin\CustomerClassPrice4\Service\PurchaseFlow\Processor;


use Eccube\Annotation\ShoppingFlow;
use Eccube\Entity\Customer;
use Eccube\Entity\ItemHolderInterface;
use Eccube\Entity\Order;
use Eccube\Service\PurchaseFlow\ItemHolderPreprocessor;
use Eccube\Service\PurchaseFlow\PurchaseContext;

/**
 * 受注データ作成時に会員種別を登録
 *
 * Class OrderPreProcessor
 * @package Plugin\CustomerClassPrice4\Service\PurchaseFlow\Processor
 *
 * @ShoppingFlow()
 */
class OrderPreProcessor implements ItemHolderPreprocessor
{
    /**
     * @inheritDoc
     */
    public function process(ItemHolderInterface $itemHolder, PurchaseContext $context)
    {
        // TODO: Implement process() method.
        if (!$itemHolder instanceof Order) {
            return;
        }

        $Customer = $itemHolder->getCustomer();
        if ($Customer instanceof Customer) {
            $itemHolder->setPlgCcpCustomerClass($Customer->getPlgCcpCustomerClass());
        }
    }
}
