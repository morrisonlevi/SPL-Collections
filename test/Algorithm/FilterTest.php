<?php

namespace PHP\Algorithm;


class FilterTest extends \PHPUnit_Framework_TestCase {

    static function filter_odd($value, $key) {
        return $value % 2;
    }


    function test_filter() {
        $in = [1,2,3,4];
        $out = filter($in, [$this, 'filter_odd']);

        $expect = [0 => 1, 2 => 3];
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_array_filter() {
        $in = [1,2,3,4];
        $out = array_filter($in, [$this, 'filter_odd']);

        $expect = [0 => 1, 2 => 3];
        $this->assertEquals($expect, $out);
    }


    function test_string_filter() {
        $in = '1234';
        $out = string_filter($in, [$this, 'filter_odd']);

        $expect = '13';
        $this->assertEquals($expect, $out);
    }

} 