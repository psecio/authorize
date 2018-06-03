<?php

namespace Psecio\Authorize\Policy;

use \Psecio\PropAuth\Policy;

class Rbac extends \Psecio\PropAuth\Policy
{
    public function __construct($input)
    {
        echo 'perm: '.print_r($input, true)."\n";

        // See if any groups match
        // $this->hasGroups($input[0], Policy::ANY);

        // And see if any group.permissions match
        // $this->find('groups.permissions')->hasName($input[0]);

        $this->find('groups')->hasName($input[0]);

        $this->find('groups.permissions')->hasName($input[0]);
    }
}