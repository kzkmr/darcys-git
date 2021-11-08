<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1647236016f180a060957b17fb01cc50
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Snow_Monkey\\Plugin\\Editor\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Snow_Monkey\\Plugin\\Editor\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1647236016f180a060957b17fb01cc50::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1647236016f180a060957b17fb01cc50::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1647236016f180a060957b17fb01cc50::$classMap;

        }, null, ClassLoader::class);
    }
}
