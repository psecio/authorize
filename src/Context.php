<?php

namespace Psecio\Authorize;

class Context implements \ArrayAccess
{
    protected $context = [];

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->context = $data;
        }
    }

    public function set($key, $value)
    {
        $this->context[$key] = $value;
    }
    public function get($key)
    {
        return (isset($this->context[$key])) ? $this->context[$key] : null;
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }
    public function offsetSet($offset, $value)
    {
        $this->context[$offset] = $value;
    }
    public function offsetExists($offset)
    {
        return isset($this->context);
    }
    public function offsetUnset($offset)
    {
        if (isset($this->context[$offset])) {
            unset($this->context[$offset]);
        }
    }

}