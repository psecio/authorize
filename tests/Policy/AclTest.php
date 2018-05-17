<?php

namespace Psecio\Authorize\Policy;

use PHPUnit\Framework\TestCase;

class ActTest extends TestCase
{
    public function testIdentifierCheck()
    {
        $input = 'test';
        $acl = new Acl($input);
        $checks = $acl->getChecks();

        // Make sure the check is set
        $this->assertTrue(isset($checks['identifier']));

        // Be sure the check is matching the right thing
        $check = $checks['identifier'][0];
        $this->assertEquals($input, $check->getValue());
    }
}