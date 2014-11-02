<?php

namespace PHP\Algorithm;


class ProxyTest extends \PHPUnit_Framework_TestCase {

    static function odd($value, $key) {
        return $value % 2;
    }


    function test_filter() {
        $out = proxy([0,1,2,3])
            ->filter([$this, 'odd'])
            ->unbox();

        $expect = [1 => 1, 3 => 3];
        $this->assertInstanceOf('\Iterator', $out);
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_map() {
        $out = proxy([0,1,2,3])
            ->map([$this, 'odd'])
            ->unbox();

        $expect = [0,1,0,1];
        $this->assertInstanceOf('\Iterator', $out);
        $this->assertEquals($expect, iterator_to_array($out));
    }


    function test_handlers() {
        $handlers = ['test' => function(array $data){ return $data[0];}];
        $out = proxy([1,2,3], $handlers)
            ->test()
            ->unbox();
        $this->assertEquals(1, $out);
    }


    function test() {
        $ans = proxy(range(1,50))
            ->filter(function($value) { return $value % 2; })
            ->map(function($value) { return $value * 2; })
            ->reduce(0, function($carry, $value) { return $carry + $value; })
            ->unbox();
        $this->assertEquals(1250, $ans);
    }


}
