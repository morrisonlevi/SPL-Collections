<?php

namespace PHP\Algorithm;


function string_reduce(/* string */ $in, $initial, callable $f) {
    $carry = $initial;
    foreach (string_iterator($in) as $key => $value) {
        $carry = $f($carry, $value, $key);
    }
    return $carry;
}

function array_reduce(array $in, $initial, callable $f) {
    $carry = $initial;
    foreach ($in as $key => $value) {
        $carry = $f($carry, $value, $key);
    }
    return $carry;
}


function iterator_reduce(\Iterator $in, $initial, callable $f) {
    $carry = $initial;
    foreach ($in as $key => $value) {
        $carry = $f($carry, $value, $key);
    }
    return $carry;
}


function reduce($in, $initial, callable $f) {
    $carry = $initial;
    foreach (to_iterator($in) as $key => $value) {
        $carry = $f($carry, $value, $key);
    }
    return $carry;
}