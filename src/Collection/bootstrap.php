<?php

namespace PHP\Collection;


function autoload(/* string */ $class)/* : bool */ {

    static $collection_namespace = 'PHP\\Collection\\';

    // Only load stuff under the PHP\Collection namespace
    if (strpos($class, $collection_namespace) !== 0) {
        return false;
    }

    $unprefixed_class = substr($class, strlen($collection_namespace));

    // Generates a warning if it doesn't exist; this is desired in this case
    return include __DIR__ . "/${unprefixed_class}.php";
}

spl_autoload_register('PHP\\Collection\\autoload');