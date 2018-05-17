<?php

namespace Psecio\Authorize;

abstract class Decider
{
    protected $context = [];

    public function setContext($context)
    {
        $this->context = $context;
    }
    public function getContext($key = null)
    {
        if ($key !== null) {
            return (isset($this->context[$key])) ? $this->context[$key] : null;
        } else {
            return $this->context;
        }
    }

    public abstract function execute($policy, $input);
}