<?php

namespace Psecio\Authorize\Policy\Rbac;

use \Psecio\PropAuth\Policy;

class Permission extends \Psecio\PropAuth\Policy
{
    public function __construct($input)
    {
        $this->find('groups.permissions')->hasName($input[0]);
    }
}