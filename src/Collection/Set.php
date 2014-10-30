<?php

namespace PHP\Collection;


interface Set extends Enumerable {


    /**
     * @param mixed $value
     * @return void
     */
    function add($value);


    /**
     * @param mixed $value
     * @return bool
     */
    function has($value);


    /**
     * @param mixed $value
     * @return void
     */
    function remove($value);


} 