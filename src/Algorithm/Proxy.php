<?php

namespace PHP\Algorithm;


class Proxy {

    private $target;
    private $handlers = [];


    /**
     * @param $target
     * @param array $handlers A map of method names to callables
     */
    function __construct($target, array $handlers = []) {
        $this->target = $target;
        $this->handlers = $handlers;
    }


    function __call($name, array $args) {
        $f = isset($this->handlers[$name])
            ? $this->handlers[$name]
            : __NAMESPACE__ . "\\$name";
        return $f($this->target, ...$args);
    }


    function __get($name) {
        return $this->target[$name];
    }


    function __set($name, $value) {
        $this->target[$name] = $value;
    }


    function __isset($name) {
        return isset($this->target[$name]);
    }


    function __unset($name) {
        unset($this->target[$name]);
    }


}


function proxy($in, array $handlers = []) {
    return new Proxy($in, $handlers);
}
