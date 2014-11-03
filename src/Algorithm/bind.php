<?php

namespace PHP\Algorithm;


function bind(callable $f, ...$bound_args) {
    return function(...$args) use ($f, $bound_args) {
        return $f(...$bound_args, ...$args);
    };
}
