<?php

namespace Spl;


class FilteringIterator implements Enumerator {

    use OuterIterator;

    private $filter;


    function __construct(\Iterator $i, callable $f) {
        $this->filter = $f;
        $this->inner = $i;
    }


    function rewind() {
        $this->inner->rewind();
        $this->forward();
    }


    function next() {
        $this->inner->next();
        $this->forward();
    }


    private function forward() {
        $filter = $this->filter;
        while ($this->inner->valid() && !$filter($this->inner->current(), $this->inner->key())) {
            $this->inner->next();
        }
    }


} 