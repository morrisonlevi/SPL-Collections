<?php

namespace PHP\Collection;


class SortedArraySetTest extends \PHPUnit_Framework_TestCase {

	function test_empty() {
		$set = new SortedArraySet('PHP\Algorithm\compare');
		$this->assertTrue($set->isEmpty());
		$this->assertCount(0, $set);
		$this->assertFalse($set->contains(1));
	}


	function test_basic() {
		$set = new SortedArraySet('PHP\Algorithm\compare');
		$set->add(1);

		$this->assertFalse($set->isEmpty());
        $this->assertCount(1, $set);
        $this->assertTrue($set->contains(1));
	}


    function test_multiple() {
        $set = new SortedArraySet('PHP\Algorithm\compare');
        $set->add(1);
        $set->add(3);

        $this->assertFalse($set->isEmpty());
        $this->assertCount(2, $set);
        $this->assertTrue($set->contains(1));
        $this->assertTrue($set->contains(3));


        $set->add(0);
        $this->assertTrue($set->contains(0));
        $this->assertTrue($set->contains(1));
        $this->assertTrue($set->contains(3));
        $this->assertCount(3, $set);
    }


    function test_remove() {
        $set = new SortedArraySet('PHP\Algorithm\compare');
        $set->add(1);
        $set->add(2);
        $set->add(3);

        $set->remove(2);
        $this->assertCount(2, $set);
        $this->assertFalse($set->contains(2));
        $this->assertTrue($set->contains(1));
        $this->assertTrue($set->contains(3));

        $set->remove(3);
        $this->assertCount(1, $set);
        $this->assertFalse($set->contains(2));
        $this->assertFalse($set->contains(3));
        $this->assertTrue($set->contains(1));

        $set->remove(0);
        $this->assertCount(1, $set);
        $this->assertFalse($set->contains(2));
        $this->assertFalse($set->contains(3));
        $this->assertTrue($set->contains(1));

        $set->remove(1);
        $this->assertCount(0, $set);
        $this->assertFalse($set->contains(1));
        $this->assertFalse($set->contains(2));
        $this->assertFalse($set->contains(3));
    }


    function test_filter() {
        $set = new SortedArraySet('PHP\Algorithm\compare');
        for ($i = 0; $i < 4; ++$i) {
            $set->add($i);
        }
        $result = $set->filter(function($value) { return $value % 2; });
        $this->assertCount(4, $set);
        $this->assertCount(2, $result);
        $this->assertTrue($result->contains(1));
        $this->assertTrue($result->contains(3));
    }


    function test_map() {
        $set = new SortedArraySet('PHP\Algorithm\compare');
        for ($i = 0; $i < 8; ++$i) {
            $set->add($i);
        }
        $result = $set->map(function($value) { return $value % 2; });
        $this->assertCount(8, $set);
        $this->assertCount(2, $result);
        $this->assertTrue($result->contains(0));
        $this->assertTrue($result->contains(1));
    }


    function test_getIterator() {
        $set = new SortedArraySet('PHP\Algorithm\compare');
        for ($i = 0; $i < 4; ++$i) {
            $set->add($i);
        }
        $enumerator = $set->getIterator();
        $this->assertFalse($enumerator->isEmpty());
        $this->assertCount(4, $enumerator);

        $i = 0;
        foreach ($enumerator as $key => $value) {
            $this->assertEquals($i++, $value);
        }
        $this->assertEquals(4, $i);
    }


}

