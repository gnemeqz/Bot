<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf3e17fc810fe29e8638799a5b6594b59
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LINE\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LINE\\' => 
        array (
            0 => __DIR__ . '/..' . '/linecorp/line-bot-sdk/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf3e17fc810fe29e8638799a5b6594b59::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf3e17fc810fe29e8638799a5b6594b59::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
