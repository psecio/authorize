<?php

namespace Psecio\Authorize\Context;

interface RoleInterface
{
    public function getName() : string;
    public function getPermissions(): array;
}