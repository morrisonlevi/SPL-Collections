<?php

namespace PHP\Collection;


interface Enumerator extends \Iterator, Collection {

    /**
     * @link http://php.net/manual/en/iterator.valid.php
     */
    public function valid(): bool;

} 