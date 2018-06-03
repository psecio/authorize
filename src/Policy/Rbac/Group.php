<?php

namespace Psecio\Authorize\Policy\Rbac;

use \Psecio\PropAuth\Policy;

class Group extends \Psecio\PropAuth\Policy
{
    public function __construct($input)
    {
        $this->find('groups')->hasName($input[0], Policy::ANY); 
    }
}