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
        if (isset($this->handlers[$name])) {
            $f = $this->handlers[$name];
        } elseif (is_object($this->target) && method_exists($this->target, $name)) {
            $f = [$this->target, $name];
        } else {
            $f = __NAMESPACE__ . "\\$name";
        }

        return new self($f($this->target, ...$args), $this->handlers);
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


    function unbox() {
        return $this->target;
    }

}


function proxy($in, array $handlers = []) {
    return new Proxy($in, $handlers);
}
