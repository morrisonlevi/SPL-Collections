<?php


function dynamic_map(/*foreachable*/ $t, callable $f) {
    if (is_array($t)) {
        return iterator_to_array(iterator_map(new ArrayIterator($t), $f));
    } else {
        return iterator_map($t, $f);
    }
}


function iterator_map(Traversable $t, callable $f) {
    foreach ($t as $key => $value) {
        yield $key => $f($value, $key);
    }
}


function dynamic_filter(/*foreachable*/ $t, callable $f) {
    if (is_array($t)) {
        return iterator_to_array(iterator_filter(new ArrayIterator($t), $f));
    } else {
        return iterator_filter($t, $f);
    }
}


function iterator_filter(Traversable $t, callable $f) {
    foreach ($t as $key => $value) {
        if ($f($value, $key)) {
            yield $key => $value;
        }
    }
}


function dynamic_values(/*foreachable*/ $t) {
    if (is_array($t)) {
        return iterator_to_array(iterator_values(new ArrayIterator($t)));
    } else {
        return iterator_values($t);
    }
}


function iterator_values(Traversable $t) {
    foreach ($t as $value) {
        yield $value;
    }
}


function dynamic_keys(/*foreachable*/ $t) {
    if (is_array($t)) {
        return iterator_to_array(iterator_keys(new ArrayIterator($t)));
    } else {
        return iterator_keys($t);
    }
}


function iterator_keys(Traversable $t) {
    foreach ($t as $key => $value) {
        yield $key;
    }
}


function dynamic_reduce(/*foreachable*/ $t, $initial,  callable $f) {
    $carry = $initial;
    foreach ($t as $key => $value) {
        $carry = $f($value, $key);
    }
    return $carry;
}


function dynamic_sum(/*foreachable*/ $t) {
    $sum = 0;
    foreach ($t as $value) {
        $sum += $value;
    }
    return $sum;
}


function dynamic_product(/*foreachable*/ $t) {
    $product = 1;
    foreach ($t as $value) {
        $product *= $value;
    }
    return $product;
}



function dynamic_slice(/*foreachable*/ $t, $offset, $length = null) {
    if (is_array($t)) {
        return iterator_to_array(
            iterator_slice(new ArrayIterator($t), $offset, $length)
        );
    } else {
        return iterator_slice($t, $offset, $length);
    }
}


function iterator_slice(Traversable $t, $offset, $length = null) {
    $iterator = iterator_skip($t, $offset);
    if ($length !== null) {
        $iterator = iterator_limit($iterator, $length);
    }
    return $iterator;
}



function dynamic_skip(/*foreachable*/ $t, $offset, $length = null) {
    if (is_array($t)) {
        return iterator_to_array(
            iterator_skip(new ArrayIterator($t), $offset, $length)
        );
    } else {
        return iterator_skip($t, $offset, $length);
    }
}


function iterator_skip(Traversable $t, $n) {
    $i = 0;
    foreach ($t as $key => $value) {
        if ($i++ < $n) {
            continue;
        }
        yield $key => $value;
    }
}



function dynamic_limit(/*foreachable*/ $t, $offset, $length = null) {
    if (is_array($t)) {
        return iterator_to_array(
            iterator_limit(new ArrayIterator($t), $offset, $length)
        );
    } else {
        return iterator_limit($t, $offset, $length);
    }
}


function iterator_limit(Traversable $t, $n) {
    $i = 0;
    foreach ($t as $key => $value) {
        if ($i++ >= $n) {
            continue;
        }
        yield $key => $value;
    }
}
