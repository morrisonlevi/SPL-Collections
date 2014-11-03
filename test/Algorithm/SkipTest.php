<?php

namespace PHP\Algorithm;


class SkipTest extends \PHPUnit_Framework_TestCase {


    function test_skip() {
        $in = range(0, 5);
        $out = skip($in, 3);
        $expect = [3 => 3, 4 => 4, 5 => 5];
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_array_skip() {
        $in = range(0, 5);
        $out = array_skip($in, 3);
        $expect = [3 => 3, 4 => 4, 5 => 5];
        $this->assertEquals($expect, $out);
    }


    function test_array_skip_withEmptyArray_returnsEmptyArray() {
        $in = [];
        $out = array_skip($in, 3);
        $expect = [];
        $this->assertEquals($expect, $out);
    }


    function test_string_skip() {
        $in = '012345';
        $out = string_skip($in, 3);
        $expect = '345';
        $this->assertEquals($expect, $out);
    }


    function test_string_skip_withEmptyString_returnsEmptyString() {
        $in = '';
        $out = string_skip($in, 3);
        $expect = '';
        $this->assertEquals($expect, $out);
    }
} 