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

namespace Plugin\CustomerGroup\Security\Authorization\Voter;


use Eccube\Entity\Product;
use Plugin\CustomerGroup\Utils\Accessible;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Class ProductVoter
 * @package Plugin\CustomerGroup\Security\Voter
 */
class ProductVoter extends Voter
{
    const VIEW = 'view';
    const CART = 'cart';

    /**
     * @var Accessible
     */
    private $accessible;

    public function __construct(Accessible $accessible)
    {
        $this->accessible = $accessible;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @return bool
     */
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::CART])) {
            return false;
        }

        if (!$subject instanceof Product) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param Product $subject
     * @param TokenInterface $token
     * @return bool|void
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (self::VIEW === $attribute) {
            return $this->accessible->can($attribute, $subject, $token);
        }

        if (self::CART === $attribute) {
            return $this->accessible->can($attribute, $subject, $token);
        }

        throw new \LogicException();
    }
}
