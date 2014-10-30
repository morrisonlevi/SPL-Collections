<?php

namespace PHP\Algorithm;


function to_iterator($in)/* : ?\Iterator */ {
    $iterator = null;
    if ($in instanceof \Iterator) {
        $iterator = $in;
    } elseif ($in instanceof \Traversable) {
        $iterator = new \IteratorIterator($in);
    } elseif (is_array($in)) {
        $iterator = new \ArrayIterator($in);
    } elseif (is_string($in)) {
        $iterator = string_iterator($in);
    }
    return $iterator;
}
