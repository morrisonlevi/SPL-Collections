<?php

namespace PHP\Algorithm;


function string_iterator(/* string */ $in)/* : \Iterator */ {
    $len = strlen($in);
    for ($ndx = 0; $ndx < $len; ++$ndx) {
        yield $ndx => $in[$ndx];
    }
}
