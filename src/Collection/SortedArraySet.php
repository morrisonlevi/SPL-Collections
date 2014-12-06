<?php

namespace PHP\Collection;


final class SortedArraySet/*<T>*/ implements Set, \Countable {

	private /*(function(T, T): int)*/ $comparator;
	private /*array<T>*/  $data = [];


	function __construct(/*(function(T, T): int)*/ $comparator) {
		$this->comparator = $comparator;
	}


	function isEmpty()/*: bool*/ {
		return count($this->data) === 0;
	}


	function add(/*T*/ $item)/*: void*/ {
        $comparator = $this->comparator;
//        $index = $this->index_of($item);
//        $length = ($index < count($this->data) && $comparator($this->data[$index], $item) === 0)
//                ? 1
//                : 0;
//        array_splice($this->data, $index, $length, [$item]);
//        return;

		$max = count($this->data);
		for ($i = 0; $i < $max; ++$i) {
			$cmp = $comparator($this->data[$i], $item);

			if ($cmp < 0) {
				continue;
			} else if ($cmp > 0) {
                array_splice($this->data, $i, 0, [$item]);
			} else {
                $this->data[$i] = $item;
			}
			return;
		}

        $this->data[] = $item;
	}


	function contains(/*T*/ $item)/*: bool*/ {
        $count = count($this->data);
        $comparator = $this->comparator;
		if ($count === 0) {
			return false;
		}

		$min = 0;
		$max = count($this->data) - 1;

		while ($min < $max) {
			$mid = (int) floor(($min + $max) / 2);
			$cmp = $comparator($this->data[$mid], $item);
			if ($cmp < 0) {
				$min = $mid + 1;
			} else if ($cmp > 0) {
				$max = $mid - 1;
			} else {
				return true;
			}
		}
        return $comparator($this->data[$min], $item) === 0;
	}


    function remove(/*T*/ $item)/*: void*/ {
        $comparator = $this->comparator;

        $max = count($this->data);
        for ($i = 0; $i < $max; ++$i) {
            $cmp = $comparator($this->data[$i], $item);

            if ($cmp < 0) {
                continue;
            } else if ($cmp > 0) {
                break;
            } else {
                array_splice($this->data, $i, 1);
            }
            return;
        }
    }


	function count()/*: int*/ {
		return count($this->data);
	}


    function getIterator()/*: \Enumerator */ {
        return new ArrayEnumerator($this->data);
    }


    function filter(callable $f)/*: SortedArraySet */ {
        $copy = new SortedArraySet($this->comparator);
        foreach ($this->data as $key => $value) {
            if ($f($value, $key)) {
                $copy->data[] = $value;
            }
        }
        return $copy;
    }


    function map(callable $f)/*: SortedArraySet */ {
        $copy = new SortedArraySet($this->comparator);
        foreach ($this->data as $key => $value) {
            $copy->add($f($value, $key));
        }
        return $copy;
    }


//    // This function works; I just don't know if I want to use this technique
//    private function index_of(/*T*/ $item)/*: int */ {
//        $compare = $this->comparator;
//        $min = 0;
//        $max = count($this->data);
//        while ($max > $min) {
//            $mid = $min + (int) (($max - $min) / 2);
//            $cmp = $compare($this->data[$mid], $item);
//            if ($cmp < 0) {
//                $min = $mid + 1;
//            } else if (0 < $cmp) {
//                $max = $mid;
//            } else {
//                return $mid;
//            }
//        }
//        return $min;
//    }


}

