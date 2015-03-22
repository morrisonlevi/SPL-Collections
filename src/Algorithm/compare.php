<?php

namespace PHP\Algorithm;


function compare($a, $b): int {
    if ($a < $b) {
        return -1;
    } else if ($b < $a) {
        return 1;
    } else {
        return 0;
    }
}

