<?php

class TaxRuleRepository_f7111db extends \Eccube\Repository\TaxRuleRepository implements \ProxyManager\Proxy\VirtualProxyInterface
{

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $valueHolderf7111db = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializerf7111db = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesf7111db = [
        
    ];

    /**
     * {@inheritDoc}
     */
    public function newTaxRule()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'newTaxRule', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->newTaxRule();
    }

    /**
     * {@inheritDoc}
     */
    public function getByRule($Product = null, $ProductClass = null, $Pref = null, $Country = null)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'getByRule', array('Product' => $Product, 'ProductClass' => $ProductClass, 'Pref' => $Pref, 'Country' => $Country), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->getByRule($Product, $ProductClass, $Pref, $Country);
    }

    /**
     * {@inheritDoc}
     */
    public function getList()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'getList', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->getList();
    }

    /**
     * {@inheritDoc}
     */
    public function delete($TaxRule)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'delete', array('TaxRule' => $TaxRule), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->delete($TaxRule);
    }

    /**
     * {@inheritDoc}
     */
    public function clearCache()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'clearCache', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->clearCache();
    }

    /**
     * {@inheritDoc}
     */
    public function save($entity)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'save', array('entity' => $entity), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->save($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function createQueryBuilder($alias, $indexBy = null)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'createQueryBuilder', array('alias' => $alias, 'indexBy' => $indexBy), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->createQueryBuilder($alias, $indexBy);
    }

    /**
     * {@inheritDoc}
     */
    public function createResultSetMappingBuilder($alias)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'createResultSetMappingBuilder', array('alias' => $alias), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->createResultSetMappingBuilder($alias);
    }

    /**
     * {@inheritDoc}
     */
    public function createNamedQuery($queryName)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'createNamedQuery', array('queryName' => $queryName), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->createNamedQuery($queryName);
    }

    /**
     * {@inheritDoc}
     */
    public function createNativeNamedQuery($queryName)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'createNativeNamedQuery', array('queryName' => $queryName), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->createNativeNamedQuery($queryName);
    }

    /**
     * {@inheritDoc}
     */
    public function clear()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'clear', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->clear();
    }

    /**
     * {@inheritDoc}
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'find', array('id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->find($id, $lockMode, $lockVersion);
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'findAll', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->findAll();
    }

    /**
     * {@inheritDoc}
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'findBy', array('criteria' => $criteria, 'orderBy' => $orderBy, 'limit' => $limit, 'offset' => $offset), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * {@inheritDoc}
     */
    public function findOneBy(array $criteria, ?array $orderBy = null)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'findOneBy', array('criteria' => $criteria, 'orderBy' => $orderBy), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->findOneBy($criteria, $orderBy);
    }

    /**
     * {@inheritDoc}
     */
    public function count(array $criteria)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'count', array('criteria' => $criteria), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->count($criteria);
    }

    /**
     * {@inheritDoc}
     */
    public function __call($method, $arguments)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__call', array('method' => $method, 'arguments' => $arguments), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->__call($method, $arguments);
    }

    /**
     * {@inheritDoc}
     */
    public function getClassName()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'getClassName', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->getClassName();
    }

    /**
     * {@inheritDoc}
     */
    public function matching(\Doctrine\Common\Collections\Criteria $criteria)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'matching', array('criteria' => $criteria), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return $this->valueHolderf7111db->matching($criteria);
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

        unset($instance->baseInfo, $instance->authorizationChecker, $instance->tokenStorage, $instance->eccubeConfig, $instance->_entityName, $instance->_em, $instance->_class);

        \Closure::bind(function (\Eccube\Repository\TaxRuleRepository $instance) {
            unset($instance->rules);
        }, $instance, 'Eccube\\Repository\\TaxRuleRepository')->__invoke($instance);

        $instance->initializerf7111db = $initializer;

        return $instance;
    }

    /**
     * {@inheritDoc}
     */
    public function __construct(\Symfony\Bridge\Doctrine\RegistryInterface $registry, \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage, \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker, \Eccube\Repository\BaseInfoRepository $baseInfoRepository, \Eccube\Common\EccubeConfig $eccubeConfig)
    {
        static $reflection;

        if (! $this->valueHolderf7111db) {
            $reflection = $reflection ?: new \ReflectionClass('Eccube\\Repository\\TaxRuleRepository');
            $this->valueHolderf7111db = $reflection->newInstanceWithoutConstructor();
        unset($this->baseInfo, $this->authorizationChecker, $this->tokenStorage, $this->eccubeConfig, $this->_entityName, $this->_em, $this->_class);

        \Closure::bind(function (\Eccube\Repository\TaxRuleRepository $instance) {
            unset($instance->rules);
        }, $this, 'Eccube\\Repository\\TaxRuleRepository')->__invoke($this);

        }

        $this->valueHolderf7111db->__construct($registry, $tokenStorage, $authorizationChecker, $baseInfoRepository, $eccubeConfig);
    }

    /**
     * @param string $name
     */
    public function & __get($name)
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__get', ['name' => $name], $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        if (isset(self::$publicPropertiesf7111db[$name])) {
            return $this->valueHolderf7111db->$name;
        }

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf7111db;

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

        $targetObject = $this->valueHolderf7111db;
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
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__set', array('name' => $name, 'value' => $value), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf7111db;

            return $targetObject->$name = $value;
            return;
        }

        $targetObject = $this->valueHolderf7111db;
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
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__isset', array('name' => $name), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf7111db;

            return isset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderf7111db;
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
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__unset', array('name' => $name), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        $realInstanceReflection = new \ReflectionClass(get_parent_class($this));

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolderf7111db;

            unset($targetObject->$name);
            return;
        }

        $targetObject = $this->valueHolderf7111db;
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
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__clone', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        $this->valueHolderf7111db = clone $this->valueHolderf7111db;
    }

    public function __sleep()
    {
        $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, '__sleep', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;

        return array('valueHolderf7111db');
    }

    public function __wakeup()
    {
        unset($this->baseInfo, $this->authorizationChecker, $this->tokenStorage, $this->eccubeConfig, $this->_entityName, $this->_em, $this->_class);

        \Closure::bind(function (\Eccube\Repository\TaxRuleRepository $instance) {
            unset($instance->rules);
        }, $this, 'Eccube\\Repository\\TaxRuleRepository')->__invoke($this);
    }

    /**
     * {@inheritDoc}
     */
    public function setProxyInitializer(\Closure $initializer = null)
    {
        $this->initializerf7111db = $initializer;
    }

    /**
     * {@inheritDoc}
     */
    public function getProxyInitializer()
    {
        return $this->initializerf7111db;
    }

    /**
     * {@inheritDoc}
     */
    public function initializeProxy() : bool
    {
        return $this->initializerf7111db && ($this->initializerf7111db->__invoke($valueHolderf7111db, $this, 'initializeProxy', array(), $this->initializerf7111db) || 1) && $this->valueHolderf7111db = $valueHolderf7111db;
    }

    /**
     * {@inheritDoc}
     */
    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolderf7111db;
    }

    /**
     * {@inheritDoc}
     */
    public function getWrappedValueHolderValue()
    {
        return $this->valueHolderf7111db;
    }


}
