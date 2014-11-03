<?php

namespace PHP\Algorithm;


class SliceTest extends \PHPUnit_Framework_TestCase {


    function test_slice() {
        $in = range(0, 5);
        $out = slice($in, 2, 4);
        $expect = [2 => 2, 3 => 3, 4 => 4];
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_slice_startOverCount_returnsEmpty() {
        $in = range(0, 1);
        $out = slice($in, 2, 4);
        $expect = [];
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_array_slice() {
        $in = range(0, 5);
        $out = array_slice($in, 2, 4);
        $expect = [2 => 2, 3 => 3, 4 => 4];
        $this->assertEquals($expect, $out);
    }


    function test_array_slice_startOverCount_returnsEmpty() {
        $in = range(0, 1);
        $out = array_slice($in, 2, 4);
        $expect = [];
        $this->assertEquals($expect, $out);
    }


    function test_string_slice() {
        $in = '012345';
        $out = string_slice($in, 2, 4);
        $expect = '234';
        $this->assertEquals($expect, $out);
    }


    function test_string_slice_startOverCount_returnsEmpty() {
        $in = '01';
        $out = string_slice($in, 2, 4);
        $expect = '';
        $this->assertEquals($expect, $out);
    }


}
