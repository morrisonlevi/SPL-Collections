<?php

namespace PHP\Algorithm;


function iterator_to_string(\Iterator $in)/* : string */ {
    $out = '';
    foreach ($in as $value) {
        $out .= $value;
    }
    return $out;
}
