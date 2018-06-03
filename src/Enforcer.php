<?php

namespace Psecio\Authorize;

class Enforcer
{
    protected $policies = [];
    protected $matchType;

    const MATCH_ANY = 'any';
    const MATCH_ALL = 'all';
    const MATCH_NONE = 'none';

    public function __construct($policy, $matchType = null)
    {
        $this->setPolicy($policy);

        // Default to "match all"
        if ($matchType == null) {
            $matchType = self::MATCH_ALL;
        }
        $this->setMatchType($matchType);
    }

    public function setPolicy($policy)
    {
        if (!is_array($policy)) {
            $policy = [$policy];
        }
        $this->policies = $policy;
    }

    public function setMatchType($matchType)
    {
        $this->matchType = $matchType;
    }

    public function getMatchType()
    {
        return $this->matchType;
    }

    public function getPolicies()
    {
        return $this->policies;
    }

    public function verify(...$input)
    {
        $policies = $this->policies;
        $pass = true;
        $pass = [];

        $enforcer = new \Psecio\PropAuth\Enforcer();
        foreach ($policies as $policy) {
            if (!($input[0] instanceof \Psecio\Authorize\Context\SubjectInterface)) {
                $subject = new \Psecio\Authorize\Context\Subject([
                    'identifier' => $input[0]
                ]);
            } else {
                $subject = $input[0];
            }

            $pass[] = $enforcer->evaluate($subject, $policy);
        }

        // Vet results against the match type (all vs any)
        switch($this->getMatchType())
        {
            case self::MATCH_ALL:
                // If there are any false, this fails
                return (array_search(false, $pass) !== false) ? false : true;

            case self::MATCH_ANY:
                // If there are any true, this passes
                return (array_search(true, $pass) !== false) ? true : false;

            default:
                return false;
        }
    }
}