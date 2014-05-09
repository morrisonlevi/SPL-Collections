SPL-Collections
===============

A collaborative effort to replace the PHP SPL extension. Nothing is final.

License pending.


Functions
=========

All functions are defined in [`src/function.php`](src/function.php).

Functions that work with `array`s and `Traversable`s:
 - `Spl\filter`
 - `Spl\keys`
 - `Spl\limit`
 - `Spl\map`
 - `Spl\product`
 - `Spl\reduce`
 - `Spl\skip`
 - `Spl\slice`
 - `Spl\sum`
 - `Spl\values`

Functions that work with `Traversable`s:
 - `Spl\iterator_filter`
 - `Spl\iterator_keys`
 - `Spl\iterator_limit`
 - `Spl\iterator_map`
 - `Spl\iterator_skip`
 - `Spl\iterator_slice`
 - `Spl\iterator_values`


Interfaces
==========

 - [`Spl\Collection`](src/Collection.php)
 - [`Spl\Enumerable`](src/Enumerable.php)
 - [`Spl\Enumerator`](src/Enumerator.php)
 - [`Spl\Map`](src/Map.php)
 - [`Spl\Set`](src/Set.php)


Classes
=======

 - [`Spl\FilteringIterator`](src/Iterator/FilteringIterator.php)
 - [`Spl\IteratorToCollectionAdapter`](src/Iterator/IteratorToCollectionAdapter.php)
 - [`Spl\MappingIterator`](src/Iterator/MappingIterator.php)
 - [`Spl\Vector`](src/Vector.php)
