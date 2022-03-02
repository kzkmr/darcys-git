<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite502c907a8f792ac5dfad462b19e0a2e
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Snow_Monkey\\Plugin\\Blocks\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Snow_Monkey\\Plugin\\Blocks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite502c907a8f792ac5dfad462b19e0a2e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite502c907a8f792ac5dfad462b19e0a2e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite502c907a8f792ac5dfad462b19e0a2e::$classMap;

        }, null, ClassLoader::class);
    }
}
