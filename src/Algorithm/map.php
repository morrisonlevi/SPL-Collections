<?php

namespace PHP\Algorithm;


function string_map(/* string */ $in, callable $f) /* : string */ {
	$out = '';
	foreach (string_iterator($in) as $key => $value) {
		$out .= $f($value, $key);
	}
	return $out;
}


function array_map(array $in, callable $value_mapper, callable $key_mapper = null)/* : array */ {
	$out = [];
	if ($key_mapper) {
		foreach ($in as $key => $value) {
			$out[$key_mapper($value, $key)] = $value_mapper($value, $key);
		}
	} else {
		foreach ($in as $key => $value) {
			$out[$key] = $value_mapper($value, $key);
		}
	}
	return $out;
}


function iterator_map(\Iterator $in, callable $value_mapper, callable $key_mapper = null)/* : \Iterator */ {
	if ($key_mapper) {
		foreach ($in as $key => $value) {
			yield $key_mapper($value, $key) => $value_mapper($value, $key);
		}
	} else {
		foreach ($in as $key => $value) {
			yield $key => $value_mapper($value, $key);
		}
	}
}


function map(/* array|string|Traversable */ $in, callable $value_mapper, callable $key_mapper = null)/* : \Iterator */ {
	return iterator_map(to_iterator($in), $value_mapper, $key_mapper);
}
