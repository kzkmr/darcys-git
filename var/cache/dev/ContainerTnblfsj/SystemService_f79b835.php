<?php

class SystemService_f79b835 extends \Eccube\Service\SystemService implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolderf79b835 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerf79b835 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesf79b835 = [
        
    ];

    /**
     * {@inheritDoc}
     */
    public function getDbversion()
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'getDbversion', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->getDbversion();
    }

    /**
     * {@inheritDoc}
     */
    public function canSetMemoryLimit($memory)
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'canSetMemoryLimit', array('memory' => $memory), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->canSetMemoryLimit($memory);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemoryLimit()
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'getMemoryLimit', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->getMemoryLimit();
    }

    /**
     * {@inheritDoc}
     */
    public function switchMaintenance($isEnable = false, $mode = 'auto_maintenance')
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'switchMaintenance', array('isEnable' => $isEnable, 'mode' => $mode), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->switchMaintenance($isEnable, $mode);
    }

    /**
     * {@inheritDoc}
     */
    public function disableMaintenanceEvent(\Symfony\Component\HttpKernel\Event\PostResponseEvent $event)
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'disableMaintenanceEvent', array('event' => $event), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->disableMaintenanceEvent($event);
    }

    /**
     * {@inheritDoc}
     */
    public function disableMaintenance($mode = 'auto_maintenance')
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'disableMaintenance', array('mode' => $mode), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->disableMaintenance($mode);
    }

    /**
     * {@inheritDoc}
     */
    public function isMaintenanceMode()
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'isMaintenanceMode', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return $this->valueHolderf79b835->isMaintenanceMode();
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

        unset($instance->entityManager, $instance->container);

        \Closure::bind(function (\Eccube\Service\SystemService $instance) {
            unset($instance->disableMaintenanceAfterResponse, $instance->maintenanceMode);
        }, $instance, 'Eccube\\Service\\SystemService')->__invoke($instance);

        $instance->initializerf79b835 = $initializer;

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager, \Symfony\Component\DependencyInjection\ContainerInterface $container)
    {
        static $reflection;

        if (! $this->valueHolderf79b835) {
            $reflection = $reflection ?: new \ReflectionClass('Eccube\\Service\\SystemService');
            $this->valueHolderf79b835 = $reflection->newInstanceWithoutConstructor();
        unset($this->entityManager, $this->container);

        \Closure::bind(function (\Eccube\Service\SystemService $instance) {
            unset($instance->disableMaintenanceAfterResponse, $instance->maintenanceMode);
        }, $this, 'Eccube\\Service\\SystemService')->__invoke($this);

        }

        $this->valueHolderf79b835->__construct($entityManager, $container);
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__get', ['name' => $name], $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        if (isset(self::$publicPropertiesf79b835[$name])) {
            return $this->valueHolderf79b835->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf79b835;

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

        $targetObject = $this->valueHolderf79b835;
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
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf79b835;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolderf79b835;
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
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__isset', array('name' => $name), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf79b835;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderf79b835;
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
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__unset', array('name' => $name), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf79b835;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderf79b835;
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
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__clone', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        $this->valueHolderf79b835 = clone $this->valueHolderf79b835;
    }

    public function __sleep()
    {
        $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, '__sleep', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;

        return array('valueHolderf79b835');
    }

    public function __wakeup()
    {
        unset($this->entityManager, $this->container);

        \Closure::bind(function (\Eccube\Service\SystemService $instance) {
            unset($instance->disableMaintenanceAfterResponse, $instance->maintenanceMode);
        }, $this, 'Eccube\\Service\\SystemService')->__invoke($this);
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializerf79b835 = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializerf79b835;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy() : bool
    {
        return $this->initializerf79b835 && ($this->initializerf79b835->__invoke($valueHolderf79b835, $this, 'initializeProxy', array(), $this->initializerf79b835) || 1) && $this->valueHolderf79b835 = $valueHolderf79b835;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderf79b835;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderf79b835;
    }


}
