<?php

namespace PHP\Collection;


class ArrayEnumerator implements Enumerator, \Countable {

    use OuterEnumerator;


    function __construct(array $array) {
        $this->inner = new \ArrayIterator($array);
    }


    function isEmpty(): bool {
        return count($this->inner) === 0;
    }


    function count(): int {
        return count($this->inner);
    }


}

