<?php

namespace PHP\Collection;


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
        $this->setExpectedException('\Exception');

        $vector = new Vector();
        $vector['not an integer'] = 1;
    }


    function test_offsetGet_withIntegerString_returnsValue() {
        $vector = new Vector(new \ArrayIterator([1]));
        $vector[0] = 1;
        $this->assertEquals(1, $vector['0']);
    }


} 