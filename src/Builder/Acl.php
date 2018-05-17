<?php

namespace Psecio\Authorize\Builder;

use Psecio\Authorize\Auth;

class Acl implements \Psecio\Authorize\BuilderInterface
{
    public static function build($input) : \Psecio\Authorize\Enforcer
    {
        return Auth::build('acl', $input);
    }
}