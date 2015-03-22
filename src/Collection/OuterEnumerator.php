<?php

namespace PHP\Collection;


trait OuterEnumerator {

    /**
     * @var \Iterator
     */
    private $inner;


    function isEmpty(): bool {
        $iterator = clone $this->inner;
        $iterator->rewind();
        return !$iterator->valid();
    }


    /**
     * @param callable $f ($value): mixed
     * @return Collection
     */
    function map(callable $f) {
        return new MappingEnumerator($this->inner, $f);
    }


    /**
     * @param callable $f ($value): bool
     * @return Collection
     */
    function filter(callable $f) {
        return new FilteringEnumerator($this->inner, $f);
    }


    function rewind() {
        $this->inner->rewind();
    }


    function valid(): bool {
        return $this->inner->valid();
    }


    function next() {
        $this->inner->next();
    }


    function current() {
        return $this->inner->current();
    }


    function key() {
        return $this->inner->key();
    }


} 