<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdadc22e7e98c92639f60f83f809628a3
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\MySQL\\' => 16,
            'Workerman\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\MySQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/mysql/src',
        ),
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdadc22e7e98c92639f60f83f809628a3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdadc22e7e98c92639f60f83f809628a3::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdadc22e7e98c92639f60f83f809628a3::$classMap;

        }, null, ClassLoader::class);
    }
}