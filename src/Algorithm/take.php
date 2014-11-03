<?php

namespace PHP\Algorithm;


function string_take(/* string */ $in, $n)/* : string */ {
    assert($n >= 0);
    if (strlen($in) === 0) {
        return '';
    }
    return substr($in, 0, $n);
}


function array_take(array $in, $n)/* : array */ {
    assert($n >= 0);
    return \array_slice($in, 0, $n, $preserve_keys = true);
}


function iterator_take(\Iterator $in, $n)/* : \Iterator */ {
    assert($n >= 0);
    $i = 0;
    foreach ($in as $key => $value) {
        if ($i++ >= $n) {
            break;
        }
        yield $key => $value;
    }
}


function take(/* array|string|\Traversable */ $in, $n) {
    return iterator_take(to_iterator($in), $n);
}