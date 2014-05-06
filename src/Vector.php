<?php

namespace Spl;


/**
 * Vector is a specialization of Map<int,V> that throws exceptions when passed non-integer keys
 * and on out of bounds offsets.
 */
class Vector implements Map {


    private $values;
    private $capacity;


    /**
     * @param int $capacity
     * @param mixed $initial Value to populate the Vector with
     */
    function __constructor($capacity, $initial) {
        $this->values = new \SplFixedArray($capacity);
        $this->capacity = $capacity;
        for ($i = 0; $i < $capacity; ++$i) {
            $this->values[$i] = $initial;
        }
    }


    /**
     * @return bool
     */
    function isEmpty() {
        return $this->capacity === 0;
    }


    /**
     * @param callable $f ($value): mixed
     * @return Collection
     */
    function map(callable $f) {
        return $this->getIterator()->map($f);
    }


    /**
     * @param callable $f ($value): bool
     * @return Collection
     */
    function filter(callable $f) {
        return $this->getIterator()->filter($f);
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param int $offset
     * @return bool
     *
     * @throws \Exception
     */
    function offsetExists($offset) {
        $index = $this->guardInteger($offset);
        return $index >= 0  && $index < $this->capacity;
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param int $offset
     * @return mixed
     *
     * @throws \Exception
     */
    function offsetGet($offset) {
        $index = $this->guardInteger($offset);
        $this->guardExists($index);
        return $this->values[$index];
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param int $offset
     * @param mixed $value
     * @return void
     *
     * @throws \Exception
     */
    function offsetSet($offset, $value) {
        $index = $this->guardInteger($offset);
        $this->guardExists($index);
        $this->values[$index] = $value;
    }


    /**
     * You cannot delete an index in a Vector; always throws an exception.
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param int $offset
     * @return void
     *
     * @throws \Exception
     */
    function offsetUnset($offset) {
        throw new \Exception;
    }


    /**
     * @return Enumerator
     */
    function getIterator() {
        return new IteratorToCollectionAdapter($this->values);
    }


    /**
     * A Vector size always of the size it was created with.
     * @link http://php.net/manual/en/class.countable.php
     * @return int
     */
    function count() {
        return $this->capacity;
    }


    private function guardExists($offset) {
        if (!$this->offsetExists($offset)) {
            throw new \Exception();
        }
        return $offset;
    }


    private function guardInteger($offset) {
        $filtered = filter_var($offset, FILTER_VALIDATE_INT, FILTER_FLAG_ALLOW_OCTAL|FILTER_FLAG_ALLOW_HEX);
        if ($filtered === false) {
            throw new \Exception();
        }
        return $filtered;

    }

} 