<?php

namespace PHP\Algorithm;


function string_filter(/* string */ $in, callable $f)/* : string */ {
    $out = '';
    foreach (string_iterator($in) as $key => $value) {
        if ($f($value, $key)) {
            $out .= $value;
        }
    }
    return $out;
}


function array_filter(array $in, callable $f)/* : array */ {
    $out = [];
    foreach ($in as $key => $value) {
        if ($f($value, $key)) {
            $out[$key] = $value;
        }
    }
    return $out;
}


function iterator_filter(\Traversable $in, callable $f)/* : \Iterator */ {
    foreach ($in as $key => $value) {
        if ($f($value, $key)) {
            yield $key => $value;
        }
    }
}


function filter(/* array|string|Iterator */ $in, callable $f)/* : \Iterator */ {
    return iterator_filter(to_iterator($in), $f);
}
