<?php

namespace PHP\Algorithm;


class TakeTest extends \PHPUnit_Framework_TestCase {


    function test_take() {
        $in = range(0,5);
        $out = take($in, 3);
        $expect = range(0,2);
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_take_withEmpty_returnsEmpty() {
        $in = [];
        $out = take($in, 3);
        $expect = [];
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_string_take() {
        $in = '012345';
        $out = string_take($in, 3);
        $expect = '012';
        $this->assertEquals($expect, $out);
    }


    function test_string_take_withEmptyString_returnsEmptyString() {
        $in = '';
        $out = string_take($in, 3);
        $expect = '';
        $this->assertEquals($expect, $out);
    }


    function test_array_take() {
        $in = range(0, 5);
        $out = array_take($in, 3);
        $expect = range(0,2);
        $this->assertEquals($expect, $out);
    }


    function test_array_take_withEmptyArray_returnsEmptyArray() {
        $in = [];
        $out = array_take($in, 3);
        $expect = [];
        $this->assertEquals($expect, $out);
    }
} 