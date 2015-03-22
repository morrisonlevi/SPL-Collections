<?php

namespace PHP\Collection;


interface Collection extends \Traversable {


    function isEmpty(): bool;


    /**
     * @param callable $f($value): mixed
     * @return Collection
     */
    function map(callable $f);


    /**
     * @param callable $f($value): bool
     * @return Collection
     */
    function filter(callable $f);


} 