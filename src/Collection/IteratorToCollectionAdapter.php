<?php

namespace PHP\Collection;


class IteratorToCollectionAdapter implements Enumerator {

    use OuterEnumerator;


    function __construct(\Iterator $i) {
        $this->inner = $i;
    }

} 