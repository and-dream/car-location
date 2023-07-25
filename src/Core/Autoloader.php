<?php

namespace App\Core;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(function($class) {
            $classPath = str_replace('App','src',$class);
            $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $classPath);
            // var_dump($classPath);
            require_once '..'. DIRECTORY_SEPARATOR . $classPath . '.php';
        });
    }
}

