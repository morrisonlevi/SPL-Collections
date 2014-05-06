<?php

namespace Spl;


trait OuterIterator {

    /**
     * @var \Iterator
     */
    private $inner;


    /**
     * @return bool
     */
    function isEmpty() {
        $iterator = clone $this->inner;
        $iterator->rewind();
        return !$iterator->valid();
    }


    /**
     * @param callable $f ($value): mixed
     * @return Collection
     */
    function map(callable $f) {
        return new MappingIterator($this->inner, $f);
    }


    /**
     * @param callable $f ($value): bool
     * @return Collection
     */
    function filter(callable $f) {
        return new FilteringIteratorTest($this->inner, $f);
    }


    function rewind() {
        $this->inner->rewind();
    }


    function valid() {
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