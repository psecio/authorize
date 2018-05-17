<?php

namespace Psecio\Authorize;

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testAclBuild()
    {
        $acl = Auth::build('acl', []);
        $this->assertInstanceOf('\\Psecio\\Authorize\\Enforcer', $acl);

        // Be sure it has one policy and that the policy is Acl
        $policies = $acl->getPolicies();
        $this->assertCount(1, $policies);
        $this->assertInstanceOf('\\Psecio\\Authorize\\Policy\\Acl', $policies[0]);
    }
}