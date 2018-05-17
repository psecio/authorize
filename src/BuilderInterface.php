<?php

namespace Psecio\Authorize;

interface BuilderInterface
{
    public static function build($input) : \Psecio\Authorize\Enforcer;
}