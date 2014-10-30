<?php

namespace PHP\Collection;


class FilteringEnumeratorTest extends \PHPUnit_Framework_TestCase {


    function test_rewind_skips_non_matching_data() {
        $inner = new \ArrayIterator([0, 1, 2, 3]);
        $iterator = new FilteringEnumerator($inner, function($value) {
            return $value % 2 === 1;
        });

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(1, $iterator->current());
    }


    function test_rewind_does_not_skip_matching_data() {
        $inner = new \ArrayIterator([0, 1, 2, 3]);
        $iterator = new FilteringEnumerator($inner, function($value) {
            return $value % 2 === 0;
        });

        $iterator->rewind();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(0, $iterator->current());
    }


    /**
     * @depends test_rewind_skips_non_matching_data
     */
    function test_next_skips_non_matching_data() {
        $inner = new \ArrayIterator([0, 1, 2, 3]);
        $iterator = new FilteringEnumerator($inner, function($value) {
            return $value % 2 === 0;
        });

        $iterator->rewind();
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(2, $iterator->current());
    }


    /**
     * @depends test_rewind_does_not_skip_matching_data
     */
    function test_next_does_not_skip_matching_data() {
        $inner = new \ArrayIterator([0, 2]);
        $iterator = new FilteringEnumerator($inner, function($value) {
            return $value % 2 === 0;
        });

        $iterator->rewind();
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $this->assertEquals(2, $iterator->current());
    }


} 