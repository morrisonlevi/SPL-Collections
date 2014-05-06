<?php

namespace Spl;


/**
 * Vector is a fixed-size Map<int,V> that throws exceptions when passed
 * non-integer keys and on out of bounds offsets.
 */
class Vector implements Map {


    private $values;
    private $capacity = 0;


    /**
     * @param \Traversable|null $t
     */
    function __construct(\Traversable $t = null) {
        $capacity = 8;
        $this->values = $values = new \SplFixedArray($capacity);
        $size = 0;
        if ($t) {
            foreach ($t as $value) {
                if ($size === $capacity) {
                    $values->setSize($capacity * 2);
                }
                $values[$size++] = $value;
            }
        }

        $values->setSize($size);
        $this->capacity = $size;
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


    /**l
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