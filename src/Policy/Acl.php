<?php

namespace Psecio\Authorize\Policy;

use \Psecio\PropAuth\Policy;

class Acl extends \Psecio\PropAuth\Policy
{
    public function __construct($input, $matchType)
    {
        $this->hasIdentifier($input, $matchType);
    }
}