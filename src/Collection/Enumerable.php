<?php

namespace PHP\Collection;


interface Enumerable extends \IteratorAggregate, Collection {


    function getIterator(): Enumerator;


}