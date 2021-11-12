<?php

class TaxRuleService_289f969 extends \Eccube\Service\TaxRuleService implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolder289f969 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer289f969 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicProperties289f969 = [
        
    ];

    /**
     * {@inheritDoc}
     */
    public function getTax($price, $product = null, $productClass = null, $pref = null, $country = null)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'getTax', array('price' => $price, 'product' => $product, 'productClass' => $productClass, 'pref' => $pref, 'country' => $country), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return $this->valueHolder289f969->getTax($price, $product, $productClass, $pref, $country);
    }

    /**
     * {@inheritDoc}
     */
    public function getPriceIncTax($price, $product = null, $productClass = null, $pref = null, $country = null)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'getPriceIncTax', array('price' => $price, 'product' => $product, 'productClass' => $productClass, 'pref' => $pref, 'country' => $country), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return $this->valueHolder289f969->getPriceIncTax($price, $product, $productClass, $pref, $country);
    }

    /**
     * {@inheritDoc}
     */
    public function calcTax($price, $taxRate, $RoundingType, $taxAdjust = 0)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'calcTax', array('price' => $price, 'taxRate' => $taxRate, 'RoundingType' => $RoundingType, 'taxAdjust' => $taxAdjust), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return $this->valueHolder289f969->calcTax($price, $taxRate, $RoundingType, $taxAdjust);
    }

    /**
     * {@inheritDoc}
     */
    public function calcTaxIncluded($price, $taxRate, $RoundingType, $taxAdjust = 0)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'calcTaxIncluded', array('price' => $price, 'taxRate' => $taxRate, 'RoundingType' => $RoundingType, 'taxAdjust' => $taxAdjust), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return $this->valueHolder289f969->calcTaxIncluded($price, $taxRate, $RoundingType, $taxAdjust);
    }

    /**
     * {@inheritDoc}
     */
    public function roundByRoundingType($value, $RoundingType)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'roundByRoundingType', array('value' => $value, 'RoundingType' => $RoundingType), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return $this->valueHolder289f969->roundByRoundingType($value, $RoundingType);
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

        unset($instance->BaseInfo, $instance->taxRuleRepository);

        $instance->initializer289f969 = $initializer;

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function __construct(\Eccube\Repository\TaxRuleRepository $taxRuleRepository, \Eccube\Repository\BaseInfoRepository $baseInfoRepository)
    {
        static $reflection;

        if (! $this->valueHolder289f969) {
            $reflection = $reflection ?: new \ReflectionClass('Eccube\\Service\\TaxRuleService');
            $this->valueHolder289f969 = $reflection->newInstanceWithoutConstructor();
        unset($this->BaseInfo, $this->taxRuleRepository);

        }

        $this->valueHolder289f969->__construct($taxRuleRepository, $baseInfoRepository);
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__get', ['name' => $name], $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        if (isset(self::$publicProperties289f969[$name])) {
            return $this->valueHolder289f969->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder289f969;

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

        $targetObject = $this->valueHolder289f969;
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
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder289f969;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolder289f969;
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
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__isset', array('name' => $name), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder289f969;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder289f969;
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
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__unset', array('name' => $name), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder289f969;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolder289f969;
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
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__clone', array(), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        $this->valueHolder289f969 = clone $this->valueHolder289f969;
    }

    public function __sleep()
    {
        $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, '__sleep', array(), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;

        return array('valueHolder289f969');
    }

    public function __wakeup()
    {
        unset($this->BaseInfo, $this->taxRuleRepository);
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializer289f969 = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializer289f969;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy() : bool
    {
        return $this->initializer289f969 && ($this->initializer289f969->__invoke($valueHolder289f969, $this, 'initializeProxy', array(), $this->initializer289f969) || 1) && $this->valueHolder289f969 = $valueHolder289f969;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder289f969;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder289f969;
    }


}
