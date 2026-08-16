<?php

namespace includes;
class Autoloader {
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class)
    {
        $chemin = str_replace('\\', '/', $class);
        $file = __DIR__ . '/../' . $chemin . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
}
