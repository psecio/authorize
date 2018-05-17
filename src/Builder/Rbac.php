<?php

namespace Psecio\Authorize\Builder;

use Psecio\Authorize\Auth;

class Rbac implements \Psecio\Authorize\BuilderInterface
{
    public static function build($input) : \Psecio\Authorize\Enforcer
    {
        return Auth::build('rbac', $input);
    }
}