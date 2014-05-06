<?php

namespace Spl;


class IteratorToCollectionAdapter implements Enumerator {

    use OuterIterator;


    function __construct(\Iterator $i) {
        $this->inner = $i;
    }

} 