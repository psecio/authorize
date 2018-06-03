<?php

namespace Psecio\Authorize\Policy;

use \Psecio\PropAuth\Policy;

class Permission extends \Psecio\PropAuth\Policy
{
    public function __construct($input, $matchType)
    {
        echo 'perm policy'."\n";

        echo 'input: '.print_r($input, true)."\n";
        $this->hasPermissions($input, Policy::ANY);
    }
}