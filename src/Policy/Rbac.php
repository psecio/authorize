<?php

namespace Psecio\Authorize\Policy;

use \Psecio\PropAuth\Policy;

class Rbac extends \Psecio\PropAuth\Policy
{
    public function __construct($input)
    {
        $this->hasGroup($input[0], Policy::ANY);
    }
}