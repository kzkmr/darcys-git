<?php

namespace Doctrine\DBAL;

use function str_replace;
use function strtolower;
use function version_compare;

/**
 * Class to store and retrieve the version of Doctrine.
 *
 * @internal
 * @deprecated Refrain from checking the DBAL version at runtime.
 */
class Version
{
    /**
     * Current Doctrine Version.
     */
    public const VERSION = '2.12.2-DEV';

    /**
     * Compares a Doctrine version with the current one.
     *
     * @param string $version The Doctrine version to compare to.
     *
     * @return int -1 if older, 0 if it is the same, 1 if version passed as argument is newer.
     */
    public static function compare($version)
    {
        $currentVersion = str_replace(' ', '', strtolower(self::VERSION));
        $version        = str_replace(' ', '', $version);

        return version_compare($version, $currentVersion);
    }
}
