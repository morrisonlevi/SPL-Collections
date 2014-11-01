<?php

namespace PHP;


require __DIR__ . '/Algorithm/bootstrap.php';


function autoload(/* string */ $class)/* : bool */ {

    static $namespace = 'PHP\\';

    // Only load stuff under the PHP namespace
    if (strpos($class, $namespace) !== 0) {
        return false;
    }

    $unprefixed_class = substr($class, strlen($namespace));

    // Generates a warning if it doesn't exist; this is desired in this case
    return include __DIR__ . '/' . str_replace('\\', '/', $unprefixed_class) . '.php';
}

spl_autoload_register('PHP\\autoload');