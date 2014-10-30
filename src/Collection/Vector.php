<?php

namespace PHP\Collection;


/**
 * Vector is a Map<int,V> with sequential keys that does bounds checking.
 */
class Vector implements Map {


    private $values = [];


    /**
     * @param array|string|\Traversable $t
     */
    function __construct($t = null) {
        if ($t !== null) {
            foreach (\PHP\Algorithm\to_iterator($t) as $value) {
                $this->values[] = $value;
            }
        }
    }


    /**
     * @return bool
     */
    function isEmpty() {
        return count($this->values) === 0;
    }


    /**
     * @param callable $f ($value): mixed
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
     * @param callable $f ($value): bool
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
     * @throws \Exception
     */
    function offsetExists($offset) {
        $index = $this->guardInteger($offset);
        return $index >= 0  && $index < count($this->values);
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
        return new IteratorToCollectionAdapter(\PHP\Algorithm\to_iterator($this->values));
    }


    /**
     * A Vector is always of the size it was created with.
     * @link http://php.net/manual/en/class.countable.php
     * @return int
     */
    function count() {
        return $this->capacity;
    }


    /**
     * @param int $size
     * @param mixed $value
     */
    function resize($size, $value) {
        $current_size = $this->capacity;
        $this->values->setSize($size);
        if ($size > $current_size) {
            for ($i = $current_size; $i < $size; ++$i) {
                $this->values[$i] = $value;
            }
        }
    }


    private function guardExists($offset) {
        if (!$this->offsetExists($offset)) {
            throw new \Exception();
        }
        return $offset;
    }


    private function guardInteger($offset) {
        $hex_octal_okay = FILTER_FLAG_ALLOW_OCTAL | FILTER_FLAG_ALLOW_HEX;
        $clean = filter_var($offset, FILTER_VALIDATE_INT, $hex_octal_okay);
        if ($clean === false) {
            throw new \Exception();
        }
        return $clean;

    }

} 