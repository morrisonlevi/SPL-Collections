<?php

namespace PHP\Algorithm;


class ReduceTest extends  \PHPUnit_Framework_TestCase {

    static function sum($carry, $value) {
        return $carry + $value;
    }


    function test_reduce() {
        $in = range(1,9);
        $out = reduce($in, 0, [$this, 'sum']);
        $this->assertEquals(45, $out);
    }


    function test_string_reduce() {
        $in = join('', range(1,9));
        $out = string_reduce($in, 0, [$this, 'sum']);
        $this->assertEquals(45, $out);
    }


    function test_array_reduce() {
        $in = range(1,9);
        $out = array_reduce($in, 0, [$this, 'sum']);
        $this->assertEquals(45, $out);
    }

} 