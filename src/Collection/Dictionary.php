<?php

namespace PHP\Collection;


class Dictionary implements Map {

    private $storage = [];
    private $hash_function;

    function __construct(callable $hash_function = null) {
        $this->storage = [];
        $this->hash_function = $hash_function ?: 'PHP\\Algorithm\\hash';
    }


    function isEmpty(): bool {
        return empty($this->storage);
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
     * @param mixed $key
     * @return boolean
     */
    public function offsetExists($key) {
        $hash = call_user_func($this->hash_function, $key);
        return array_key_exists($hash, $this->storage);
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $key
     * @return mixed
     * @throws \PHP\LookupException
     */
    public function offsetGet($key) {
        $hash = call_user_func($this->hash_function, $key);
        $this->guardExists($hash);
        return $this->storage[$hash][1];
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    public function offsetSet($key, $value) {
        $hash = call_user_func($this->hash_function, $key);
        $this->storage[$hash] = [$key, $value];
    }


    /**
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $key
     * @return void
     */
    public function offsetUnset($key) {
        $hash = call_user_func($this->hash_function, $key);
        unset($this->storage[$hash]);
    }


    function getIterator(): Enumerator {
        return new DictionaryEnumerator($this->storage);
    }


    /**
     * @link http://php.net/manual/en/countable.count.php
     */
    public function count(): int {
        return count($this->storage);
    }


    private function guardExists($hash) {
        if (!array_key_exists($hash, $this->storage)) {
            throw new \PHP\LookupException;
        }
    }

} 