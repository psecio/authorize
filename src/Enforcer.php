<?php

namespace Psecio\Authorize;

class Enforcer
{
    protected $deciderSet = [];

    public function __construct($decider)
    {
        $this->setDecider($decider);
    }

    public function setDecider($decider)
    {
        if (!is_array($decider)) {
            $decider = [$decider];
        }
        $this->deciderSet = $decider;
    }

    // public function verify(\Psecio\Authorize\Context $context)
    public function verify(...$input)
    {
        $deciders = $this->deciderSet;

        // A decider combines the policy instance with the input to see if there's a match

        foreach ($deciders as $decider) {
            
            echo get_class($decider)."\n";

            $result = $decider->execute($policy);
            var_export($result);
        }
    }
}