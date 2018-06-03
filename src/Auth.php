<?php

namespace Psecio\Authorize;

use \Psecio\PropAuth\PolicySet;

class Auth
{
    public static function build($type, ...$input)
    {
        $type = strtolower($type);
        $match = Enforcer::MATCH_ALL;

        switch($type) {
            case 'acl':
                $policy = self::buildPolicy('acl', $input[0]);
                break;
            case 'permission':
                $policy = self::buildPolicy('permission', $input[0]);
                break;
            case 'rbac':
                // We need two policies here - one for groups and one for perms
                $policy = [
                    self::buildPolicy('rbac/group', $input),
                    self::buildPolicy('rbac/permission', $input)
                ];
                $match = Enforcer::MATCH_ANY;
                break;
            default:
                throw new \InvalidArgumentException('Unknown type: '.$type);
        }
        $enforcer = new Enforcer($policy, $match);
        return $enforcer;
    }

    private static function buildPolicy($type, $input)
    {
        // If it's already a policy, return it - no extra work here
        if ($input instanceof \Psecio\PropAuth\Policy) {
            return $input;
        }

        // See if we have a special "path"
        if (strpos($type, '/') !== false) {
            $parts = array_map(function($value) {
                return ucwords(strtolower($value));
            }, explode('/', $type));
            $type = implode('\\', $parts);
        }

        // If it's not a policy, build it
        $policyNs = '\\Psecio\\Authorize\Policy\\'.ucwords(strtolower($type));
        if (!class_exists($policyNs)) {
            throw new \Exception('Invalid policy type: '.$type);
        }
        $policy = new $policyNs($input);
        return $policy;
    }
}