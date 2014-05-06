<?php

namespace Spl;


interface Enumerable extends \IteratorAggregate, Collection {


    /**
     * @return Enumerator
     */
    function getIterator();


}