<?php

namespace Psecio\Authorize;

class Enforcer
{
    protected $policies = [];

    public function __construct($policy)
    {
        $this->setPolicy($policy);
    }

    public function setPolicy($policy)
    {
        if (!is_array($policy)) {
            $policy = [$policy];
        }
        $this->policies = $policy;
    }

    public function getPolicies()
    {
        return $this->policies;
    }

    public function verify(...$input)
    {
        $policies = $this->policies;
        $pass = true;

        // This is ALL must pass - how to allow them to say ANY?

        $enforcer = new \Psecio\PropAuth\Enforcer();
        foreach ($policies as $policy) {
            print_r($policy);
            
            if (!($input[0] instanceof \Psecio\Authorize\Context\SubjectInterface)) {
                $subject = new \Psecio\Authorize\Context\Subject([
                    'identifier' => $input[0]
                ]);
            } else {
                $subject = $input[0];
            }

            // $policy = $this->buildPolicy($decider, $input);
            echo 'PRE'."\n";
            $result = $enforcer->evaluate($subject, $policy);
            echo 'RES: '.var_export($result, true)."\n";

            if ($enforcer->evaluate($subject, $policy) == false) {
                $pass = false;
            }
        }

        return $pass;
    }
}