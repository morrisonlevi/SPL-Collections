<?php

use PHP\Collection\Vector;


class VectorTest extends \PHPUnit_Framework_TestCase {


    function test_isEmpty_vectorIsSizeZero_returnsTrue() {
        $vector = new Vector();
        $this->assertTrue($vector->isEmpty());
    }


    function test_isEmpty_vectorIsGreaterThanZero_returnsFalse() {
        $vector = new Vector([1]);
        $this->assertFalse($vector->isEmpty());
    }


    function test_setThenGet_returnsProperValue() {
        $vector = new Vector([1]);
        $this->assertEquals(1, $vector[0]);
    }


    function test_offsetSet_withNull_appendsValue() {
        $vector = new Vector(new \ArrayIterator([1]));
        $vector[] = 2;
        $this->assertEquals(2, $vector[1]);
    }


    function test_offsetSet_withNonIntegerString_throwsException() {
        $this->setExpectedException('PHP\TypeException');

        $vector = new Vector();
        $vector['not an integer'] = 1;
    }


    function test_offsetGet_withIntegerString_returnsValue() {
        $vector = new Vector(new \ArrayIterator([1]));
        $vector[0] = 1;
        $this->assertEquals(1, $vector['0']);
    }


    function test_offsetUnset_throwsException() {
        $this->setExpectedException('PHP\Exception');

        $vector = new Vector([1]);
        unset($vector[0]);
    }


    function test_offsetSet_withOutOfBoundIndex_throwsException() {
        $this->setExpectedException('PHP\LookupException');

        $vector = new Vector();
        $vector[0] = 1;
    }


    function test_count_whenEmpty_isZero() {
        $vector = new Vector();
        $this->assertCount(0, $vector);
    }


    function test_count_withN_isN() {
        $vector = new Vector();
        for ($n = 1; $n < 4; ++$n) {
            $vector[] = $n;
            $this->assertCount($n, $vector);
        }
    }


    function test_map() {
        $vector = new Vector([1,2,3,4]);
        $mapped = $vector->map(function ($value, $key) {
            return $key * 2;
        });
        $this->assertInstanceOf('PHP\\Collection\\Vector', $mapped);
        $this->assertCount(count($vector), $mapped);
        foreach ($mapped as $key => $value) {
            $this->assertEquals($key * 2, $value);
        }
    }


    function test_filter() {
        $vector = new Vector([1,2,3,4]);
        $mapped = $vector->filter(function ($value, $key) {
            return $key % 2;
        });
        $this->assertInstanceOf('PHP\\Collection\\Vector', $mapped);
        $this->assertCount(2, $mapped);
        $this->assertEquals(2, $mapped[0]);
        $this->assertEquals(4, $mapped[1]);
    }


} 