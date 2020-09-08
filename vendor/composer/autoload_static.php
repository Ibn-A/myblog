<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb7b8723d830e7b2d965d8588894792ff
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb7b8723d830e7b2d965d8588894792ff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb7b8723d830e7b2d965d8588894792ff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb7b8723d830e7b2d965d8588894792ff::$classMap;

        }, null, ClassLoader::class);
    }
}
