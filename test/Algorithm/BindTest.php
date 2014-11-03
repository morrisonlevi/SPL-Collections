<?php

namespace PHP\Algorithm;


class BindTest extends \PHPUnit_Framework_TestCase {

    static function addOne($value, $key) {
        return $value + 1;
    }

    function test_bind() {
        $in = [1, 2, 3, 4];
        $partial = bind('PHP\\Algorithm\\array_map', $in);
        $actual = $partial([$this, 'addOne']);
        $expect = \PHP\Algorithm\array_map($in, [$this, 'addOne']);
        $this->assertEquals($expect, $actual);
    }

} 