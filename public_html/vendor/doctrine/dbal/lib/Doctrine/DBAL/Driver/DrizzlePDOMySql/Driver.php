<?php

namespace Doctrine\DBAL\Driver\DrizzlePDOMySql;

use Doctrine\DBAL\Platforms\DrizzlePlatform;
use Doctrine\DBAL\Schema\DrizzleSchemaManager;

/**
 * Drizzle driver using PDO MySql.
 *
 * @deprecated
 */
class Driver extends \Doctrine\DBAL\Driver\PDOMySql\Driver
{
    /**
     * {@inheritdoc}
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        return new Connection(
            $this->constructPdoDsn($params),
            $username,
            $password,
            $driverOptions
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createDatabasePlatformForVersion($version)
    {
        return $this->getDatabasePlatform();
    }

    /**
     * {@inheritdoc}
     *
     * @return DrizzlePlatform
     */
    public function getDatabasePlatform()
    {
        return new DrizzlePlatform();
    }

    /**
     * {@inheritdoc}
     *
     * @return DrizzleSchemaManager
     */
    public function getSchemaManager(\Doctrine\DBAL\Connection $conn)
    {
        return new DrizzleSchemaManager($conn);
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated
     */
    public function getName()
    {
        return 'drizzle_pdo_mysql';
    }
}
