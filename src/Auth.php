<?php

namespace Psecio\Authorize;

class Auth
{
    public static function build($type, ...$input)
    {
        $type = strtolower($type);
        switch($type) {
            case 'acl':
                $policy = self::buildPolicy('acl', $input[0]);
                break;
            case 'permission':
                $policy = self::buildPolicy('permission', $input[0]);
                break;
            default:
                throw new \InvalidArgumentException('Unknown type: '.$type);
        }
        $enforcer = new \Psecio\Authorize\Enforcer($policy);
        return $enforcer;
    }

    private static function buildPolicy($type, $input)
    {
        // If it's already a policy, return it - no extra work here
        if ($input instanceof \Psecio\PropAuth\Policy) {
            return $input;
        }

        // If it's not a policy, build it
        $policyNs = '\\Psecio\\Authorize\Policy\\'.ucwords(strtolower($type));
        if (!class_Exists($policyNs)) {
            throw new \Exception('Invalid policy type: '.$type);
        }
        $policy = new $policyNs($input);
        return $policy;
    }
}