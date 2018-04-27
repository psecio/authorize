<?php

namespace Psecio\Authorize;

class Auth
{
    public static function build($type, ...$input)
    {
        switch(strtolower($type)) {
            case 'acl':
                $decider = new \Psecio\Authorize\Decider\Acl($input[0]);
                break;
            default:
                // nothing
        }
        $enforcer = new \Psecio\Authorize\Enforcer($decider);
        return $enforcer;
    }
}