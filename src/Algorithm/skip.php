<?php

namespace PHP\Algorithm;


function string_skip(/* string */ $in, $n)/* : array */ {
    assert($n >= 0);
    if ($n >= strlen($in)) {
        return '';
    }
    return \substr($in, $n);
}


function array_skip(array $in, $n)/* : array */ {
    assert($n >= 0);
    return \array_slice($in, $n, null, $preserve_keys = true);
}


function iterator_skip(\Iterator $in, $n) {
    assert($n >= 0);
    $i = 0;
    foreach ($in as $key => $value) {
        if ($i++ < $n) {
            continue;
        }
        yield $key => $value;
    }
}


function skip($in, $n) {
    return iterator_skip(to_iterator($in), $n);
}