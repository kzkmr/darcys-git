<?php

class CartService_9dde17f extends \Eccube\Service\CartService implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolder9dde17f = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer9dde17f = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties9dde17f = [
        
    ];

    /**
     * {@inheritDoc}
     */
    public function getCarts($empty_delete = false)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'getCarts', array('empty_delete' => $empty_delete), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->getCarts($empty_delete);
    }

    /**
     * {@inheritDoc}
     */
    public function getPersistedCarts()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'getPersistedCarts', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->getPersistedCarts();
    }

    /**
     * {@inheritDoc}
     */
    public function getSessionCarts()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'getSessionCarts', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->getSessionCarts();
    }

    /**
     * {@inheritDoc}
     */
    public function mergeFromPersistedCart()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'mergeFromPersistedCart', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->mergeFromPersistedCart();
    }

    /**
     * {@inheritDoc}
     */
    public function getCart()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'getCart', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->getCart();
    }

    /**
     * {@inheritDoc}
     */
    public function addProduct($ProductClass, $quantity = 1)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'addProduct', array('ProductClass' => $ProductClass, 'quantity' => $quantity), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->addProduct($ProductClass, $quantity);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProduct($ProductClass)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'removeProduct', array('ProductClass' => $ProductClass), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->removeProduct($ProductClass);
    }

    /**
     * {@inheritDoc}
     */
    public function save()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'save', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->save();
    }

    /**
     * {@inheritDoc}
     */
    public function setPreOrderId($pre_order_id)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'setPreOrderId', array('pre_order_id' => $pre_order_id), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->setPreOrderId($pre_order_id);
    }

    /**
     * {@inheritDoc}
     */
    public function getPreOrderId()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'getPreOrderId', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->getPreOrderId();
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'clear', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->clear();
    }

    /**
     * {@inheritDoc}
     */
    public function setCartItemComparator($cartItemComparator)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'setCartItemComparator', array('cartItemComparator' => $cartItemComparator), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->setCartItemComparator($cartItemComparator);
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimary($cartKey)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'setPrimary', array('cartKey' => $cartKey), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return $this->valueHolder9dde17f->setPrimary($cartKey);
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?: $reflection = new \ReflectionClass(__CLASS__);
        $instance = (new \ReflectionClass(get_class()))->newInstanceWithoutConstructor();

        unset($instance->carts, $instance->session, $instance->entityManager, $instance->cart, $instance->productClassRepository, $instance->cartRepository, $instance->cartItemComparator, $instance->cartItemAllocator, $instance->orderRepository, $instance->tokenStorage, $instance->authorizationChecker);

        $instance->initializer9dde17f = $initializer;

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function __construct(\Symfony\Component\HttpFoundation\Session\SessionInterface $session, \Doctrine\ORM\EntityManagerInterface $entityManager, \Eccube\Repository\ProductClassRepository $productClassRepository, \Eccube\Repository\CartRepository $cartRepository, \Eccube\Service\Cart\CartItemComparator $cartItemComparator, \Eccube\Service\Cart\CartItemAllocator $cartItemAllocator, \Eccube\Repository\OrderRepository $orderRepository, \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage, \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker)
    {
        static $reflection;

        if (! $this->valueHolder9dde17f) {
            $reflection = $reflection ?: new \ReflectionClass('Eccube\\Service\\CartService');
            $this->valueHolder9dde17f = $reflection->newInstanceWithoutConstructor();
        unset($this->carts, $this->session, $this->entityManager, $this->cart, $this->productClassRepository, $this->cartRepository, $this->cartItemComparator, $this->cartItemAllocator, $this->orderRepository, $this->tokenStorage, $this->authorizationChecker);

        }

        $this->valueHolder9dde17f->__construct($session, $entityManager, $productClassRepository, $cartRepository, $cartItemComparator, $cartItemAllocator, $orderRepository, $tokenStorage, $authorizationChecker);
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__get', ['name' => $name], $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        if (isset(self::$publicProperties9dde17f[$name])) {
            return $this->valueHolder9dde17f->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder9dde17f;

            $backtrace = debug_backtrace(false);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    get_parent_class($this),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
            return;
        }

        $targetObject = $this->valueHolder9dde17f;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder9dde17f;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolder9dde17f;
        $accessor = function & () use ($targetObject, $name, $value) {
            return $targetObject->$name = $value;
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __isset($name)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__isset', array('name' => $name), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder9dde17f;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder9dde17f;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    /**
     * @param string $name
     */
    public function __unset($name)
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__unset', array('name' => $name), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder9dde17f;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder9dde17f;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __clone()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__clone', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        $this->valueHolder9dde17f = clone $this->valueHolder9dde17f;
    }

    public function __sleep()
    {
        $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, '__sleep', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;

        return array('valueHolder9dde17f');
    }

    public function __wakeup()
    {
        unset($this->carts, $this->session, $this->entityManager, $this->cart, $this->productClassRepository, $this->cartRepository, $this->cartItemComparator, $this->cartItemAllocator, $this->orderRepository, $this->tokenStorage, $this->authorizationChecker);
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer9dde17f = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializer9dde17f;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy() : bool
    {
        return $this->initializer9dde17f && ($this->initializer9dde17f->__invoke($valueHolder9dde17f, $this, 'initializeProxy', array(), $this->initializer9dde17f) || 1) && $this->valueHolder9dde17f = $valueHolder9dde17f;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder9dde17f;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder9dde17f;
    }


}
