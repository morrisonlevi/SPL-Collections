<?php

namespace PHP\Collection;


interface Set extends Enumerable {


    /**
     * @param mixed $value
     * @return void
     */
    function add($value);


    function contains($value): bool;


    /**
     * @param mixed $value
     * @return void
     */
    function remove($value);


}
