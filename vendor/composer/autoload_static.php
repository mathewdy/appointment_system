<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac9d1d1d0c9d810bf6f386a979405290
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MessageBird\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MessageBird\\' => 
        array (
            0 => __DIR__ . '/..' . '/messagebird/php-rest-api/src/MessageBird',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac9d1d1d0c9d810bf6f386a979405290::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac9d1d1d0c9d810bf6f386a979405290::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac9d1d1d0c9d810bf6f386a979405290::$classMap;

        }, null, ClassLoader::class);
    }
}
