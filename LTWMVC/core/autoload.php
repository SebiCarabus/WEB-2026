<?php
declare(strict_types=1);
function autoload($class){
    $paths = [
        PDIR . SEP . $class . '.php',
        PDIR . SEP . 'controllers' . SEP . $class . '.php',
        PDIR . SEP . 'models' . SEP . $class . '.php',
        PDIR . SEP . 'core' . SEP . $class . '.php',
        PDIR . SEP . 'views' . SEP . $class . '.php'
    ];

    foreach ($paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            return;
        }
    }
    
    echo("[Error]: No class was found: $class");
    exit();
}
spl_autoload_register('autoload');