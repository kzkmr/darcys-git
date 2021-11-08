<?php

class Logger_fadf7f2 extends \Eccube\Log\Logger implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolderfadf7f2 = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerfadf7f2 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesfadf7f2 = [
        
    ];

    /**
     * {@inheritDoc}
     */
    public function log($level, $message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'log', array('level' => $level, 'message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->log($level, $message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function emergency($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'emergency', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->emergency($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function alert($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'alert', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->alert($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function critical($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'critical', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->critical($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function error($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'error', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->error($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function warning($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'warning', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->warning($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function notice($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'notice', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->notice($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function info($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'info', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->info($message, $context);
    }

    /**
     * {@inheritDoc}
     */
    public function debug($message, array $context = [])
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'debug', array('message' => $message, 'context' => $context), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return $this->valueHolderfadf7f2->debug($message, $context);
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

        unset($instance->context, $instance->logger, $instance->frontLogger, $instance->adminLogger);

        $instance->initializerfadf7f2 = $initializer;

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function __construct(\Eccube\Request\Context $context, \Psr\Log\LoggerInterface $logger, \Psr\Log\LoggerInterface $frontLogger, \Psr\Log\LoggerInterface $adminLogger)
    {
        static $reflection;

        if (! $this->valueHolderfadf7f2) {
            $reflection = $reflection ?: new \ReflectionClass('Eccube\\Log\\Logger');
            $this->valueHolderfadf7f2 = $reflection->newInstanceWithoutConstructor();
        unset($this->context, $this->logger, $this->frontLogger, $this->adminLogger);

        }

        $this->valueHolderfadf7f2->__construct($context, $logger, $frontLogger, $adminLogger);
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__get', ['name' => $name], $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        if (isset(self::$publicPropertiesfadf7f2[$name])) {
            return $this->valueHolderfadf7f2->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfadf7f2;

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

        $targetObject = $this->valueHolderfadf7f2;
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
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfadf7f2;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolderfadf7f2;
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
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__isset', array('name' => $name), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfadf7f2;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderfadf7f2;
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
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__unset', array('name' => $name), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderfadf7f2;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderfadf7f2;
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
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__clone', array(), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        $this->valueHolderfadf7f2 = clone $this->valueHolderfadf7f2;
    }

    public function __sleep()
    {
        $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, '__sleep', array(), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;

        return array('valueHolderfadf7f2');
    }

    public function __wakeup()
    {
        unset($this->context, $this->logger, $this->frontLogger, $this->adminLogger);
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializerfadf7f2 = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializerfadf7f2;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy() : bool
    {
        return $this->initializerfadf7f2 && ($this->initializerfadf7f2->__invoke($valueHolderfadf7f2, $this, 'initializeProxy', array(), $this->initializerfadf7f2) || 1) && $this->valueHolderfadf7f2 = $valueHolderfadf7f2;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderfadf7f2;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderfadf7f2;
    }


}
