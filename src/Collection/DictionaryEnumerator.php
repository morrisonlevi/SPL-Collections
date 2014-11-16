<?php

namespace PHP\Collection;


class DictionaryEnumerator implements Enumerator {

    /**
     * @var \ArrayIterator
     */
    private $inner;

    function __construct(array $storage) {
        $this->inner = new \ArrayIterator($storage);
    }


    /**
     * @return bool
     */
    function isEmpty() {
        return $this->inner->count() === 0;
    }


    /**
     * @param callable $f ($value): mixed
     * @return Collection
     */
    function map(callable $f) {
        return new MappingEnumerator($this, $f);
    }


    /**
     * @param callable $f ($value): bool
     * @return Collection
     */
    function filter(callable $f) {
        return new FilteringEnumerator($this, $f);
    }


    /**
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed
     */
    public function current() {
        $entry = $this->inner->current();
        return $entry[1];
    }


    /**
     * @link http://php.net/manual/en/iterator.next.php
     * @return void
     */
    public function next() {
        $this->inner->next();
    }


    /**
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed
     */
    public function key() {
        $entry = $this->inner->current();
        return $entry[0];
    }


    /**
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean
     */
    public function valid() {
        return $this->inner->valid();
    }


    /**
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void
     */
    public function rewind() {
        $this->inner->rewind();
    }
}