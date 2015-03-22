<?php

namespace PHP\Collection;


/**
 * Vector is a Map<int,V> with sequential keys that does bounds checking. Indices are checked as
 * strict integers, meaning is_int($index) must be true. This is a design trade-off: it is easier to
 * migrate code if it is made strict now and relaxed later than it is to make it relaxed now and
 * more strict later.
 */
class Vector implements Map {


    private $values = [];


    /**
     * @param array|string|\Traversable [optional] $t
     */
    function __construct($t = null) {
        if ($t !== null) {
            foreach (\PHP\Algorithm\to_iterator($t) as $value) {
                $this->values[] = $value;
            }
        }
    }


    function isEmpty(): bool {
        return count($this->values) === 0;
    }


    /**
     * @param callable $f ($value, $key): mixed
     * @return Vector
     */
    function map(callable $f) {
        $out = new self();
        foreach ($this->values as $key => $value) {
            $out[] = $f($value, $key);
        }
        return $out;
    }


    /**
     * @param callable $f ($value, $key): bool
     * @return Vector
     */
    function filter(callable $f) {
        $out = new self();
        foreach ($this->values as $key => $value) {
            if ($f($value, $key)) {
                $out[] = $value;
            }
        }
        return $out;
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param int $offset
     * @return bool
     *
     * @throws \PHP\TypeException
     */
    function offsetExists($offset) {
        $this->guardInteger($offset);
        return $offset >= 0  && $offset < count($this->values);
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param int $offset
     * @return mixed
     *
     * @throws \PHP\LookupException
     * @throws \PHP\TypeException
     */
    function offsetGet($offset) {
        $this->guardInteger($offset);
        $this->guardExists($offset);
        return $this->values[$offset];
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param int $offset
     * @param mixed $value
     * @return void
     *
     * @throws \PHP\LookupException
     * @throws \PHP\TypeException
     */
    function offsetSet($offset, $value) {
        if ($offset !== null) {
            $this->guardInteger($offset);
            $this->guardExists($offset);
            $this->values[$offset] = $value;
        } else {
            $this->values[] = $value;
        }
    }


    /**
     * Vectors must have sequential indices; therefore unset is not permitted
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param int $offset
     * @return void
     *
     * @throws \PHP\Exception
     */
    function offsetUnset($offset) {
        throw new \PHP\Exception;
    }


    function getIterator(): Enumerator {
        return new IteratorToCollectionAdapter(\PHP\Algorithm\to_iterator($this->values));
    }


    /**
     * @link http://php.net/manual/en/class.countable.php
     */
    function count(): int {
        return count($this->values);
    }


    private function guardExists($offset) {
        if (!$this->offsetExists($offset)) {
            throw new \PHP\LookupException();
        }
    }


    private function guardInteger($offset) {
        if (!is_int($offset)) {
            throw new \PHP\TypeException;
        }
    }

} 