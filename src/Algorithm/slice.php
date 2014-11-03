<?php

namespace PHP\Algorithm;


function string_slice(/* string */ $in, $start, $stop)/* : string */ {
    assert($start >= 0);
    if ($start >= strlen($in)) {
        return '';
    }

    assert($stop >= $start);
    $length = $stop - $start + 1;

    return substr($in, $start, $length);
}


function array_slice(array $in, $start, $stop)/* : array */ {
    assert($start >= 0);
    assert($stop >= $start);
    $length = $stop - $start + 1;

    return \array_slice($in, $start, $length, $preserve_key = true);
}


function iterator_slice(\Iterator $in, $start, $stop) {
    assert($start >= 0);
    assert($stop >= $start);
    return iterator_take(iterator_skip($in, $start), $stop - $start + 1);
}


function slice(/* array|string|\Traversable */ $in, $start, $stop)/* : \Iterator */ {
    return iterator_slice(to_iterator($in), $start, $stop);
}