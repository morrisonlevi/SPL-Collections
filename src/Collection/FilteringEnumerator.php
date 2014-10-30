<?php

namespace PHP\Collection;


class FilteringEnumerator implements Enumerator {

    use OuterEnumerator;

    private $filter;


    function __construct(\Iterator $i, callable $f) {
        $this->filter = $f;
        $this->inner = $i;
    }


    function rewind() {
        $this->inner->rewind();
        $this->moveToNextMatch();
    }


    function next() {
        $this->inner->next();
        $this->moveToNextMatch();
    }


    private function moveToNextMatch() {
        $filter = $this->filter;
        while ($this->inner->valid() && !$filter($this->inner->current(), $this->inner->key())) {
            $this->inner->next();
        }
    }


} 