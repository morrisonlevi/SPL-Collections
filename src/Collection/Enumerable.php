<?php

namespace PHP\Collection;


interface Enumerable extends \IteratorAggregate, Collection {


    /**
     * @return Enumerator
     */
    function getIterator();


}