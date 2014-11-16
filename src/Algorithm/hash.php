<?php

namespace PHP\Algorithm;


/**
 * hash is a general purpose hashing function for key lookups. It should not be
 * used for security. It's also slow. Use a type-aware hash algorithm when
 * possible.
 *
 * @param mixed $value
 * @return string
 */
function hash($value) {
    switch (gettype($value)) {

        case 'object':
            return spl_object_hash($value);

        case 'double':
            return 'n' . floor($value);

        case 'integer':
            return 'n' . $value;

        case 'string':
            return "s${value}";

        case 'array':
            return 'a' . md5(serialize($value));

        case 'boolean':
            return 'b'. $value;

        case 'resource':
            return 'r' . $value;

        default:
            return '\0';
    }
}