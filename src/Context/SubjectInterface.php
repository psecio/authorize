<?php

namespace Psecio\Authorize\Context;

interface SubjectInterface
{
    public function getIdentifier() : string;
    public function setIdentifier($identifier) : bool;

    public function getPermissions() : array;
    public function getGroups() : array;
}