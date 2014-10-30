<?php

namespace PHP\Collection;


class MappingEnumerator implements Enumerator {

    use OuterEnumerator;

    private $mapper;


    function __construct(\Iterator $i, callable $f) {
        $this->inner = $i;
        $this->mapper = $f;
    }


    function current() {
        return call_user_func($this->mapper, $this->inner->current(), $this->key());
    }


} 