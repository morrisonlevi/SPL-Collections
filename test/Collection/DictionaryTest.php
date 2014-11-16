<?php

namespace PHP\Algorithm;

use PHP\Collection\Dictionary;


class DictionaryTest extends \PHPUnit_Framework_TestCase {


    function test_empty_properties() {
        $dict = new Dictionary();
        $enumerator = $dict->getIterator();

        $this->assertTrue($dict->isEmpty());
        $this->assertTrue($enumerator->isEmpty());

        $this->assertCount(0, $dict);
    }


    function test_offsetSetAndOffsetGet() {
        $dict = new Dictionary();
        $dict['A'] = 'a';
        $this->assertCount(1, $dict);
        $this->assertFalse($dict->isEmpty());
        $this->assertEquals('a', $dict['A']);
    }


    function test_offsetSet_overwritesExistingValue() {
        $dict = new Dictionary();
        $dict['A'] = 'a';
        $dict['A'] = 'b';

        $this->assertEquals('b', $dict['A']);
    }


    function test_offsetGet_whenKeyDoesNotExist_throwsException() {
        $this->setExpectedException('PHP\\LookupException');

        $dict = new Dictionary();
        $dict['a'];
    }


    function test_offsetUnset() {
        $dict = new Dictionary();
        $dict['A'] = 'a';
        unset($dict['A']);
        $this->assertTrue($dict->isEmpty());
        $this->assertCount(0, $dict);
    }


    function test_offsetExists() {
        $dict = new Dictionary();
        $dict['A'] = 'a';
        $this->assertTrue($dict->offsetExists('A'));
        $this->assertFalse($dict->offsetExists('a'));
    }


    function test_filter() {
        $dict = new Dictionary();
        $dict[0] = 1;
        $dict[1] = 2;
        $dict[2] = 4;
        $dict[3] = 8;

        $actual = iterator_to_array($dict->filter(function($value) {
            return $value < 4;
        }));
        $expect = [0 => 1, 1 => 2];
        $this->assertEquals($expect,$actual);
    }


    function test_map() {
        $dict = new Dictionary();
        $dict[0] = 2;
        $dict[1] = 2;
        $dict[2] = 2;
        $dict[3] = 2;

        $result = $dict->map(function($value, $key) {
            return $value ** $key;
        });
        $actual = iterator_to_array($result);
        $expect = [0 => 1, 1 => 2, 2 => 4, 3 => 8];
        $this->assertEquals($expect,$actual);
    }

} 