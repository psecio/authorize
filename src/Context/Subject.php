<?php

namespace Psecio\Authorize\Context;

/**
 * A base Subject class. Used internally when it's necessary to create a Subject
 * This could be used externally too but it usually makes more sense for the user
 * to define their own class to act as a Subject interface
 */
class Subject implements \Psecio\Authorize\Context\SubjectInterface
{
    protected $data = [];
    
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    public function getData($key = null)
    {
        if ($key !== null) {
            return (isset($this->data[$key])) ? $this->data[$key] : null;
        } else {
            return $this->data;
        }
    }

    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function getIdentifier() : string
    {
        return $this->getData('identifier');
    }

    public function getPermissions() : array
    {
        $perm = $this->getData('permissions');
        return (is_array($perm)) ? $perm : [];
    }

    public function getGroups() : array
    {
        $groups = $this->getData('groups');
        return (is_array($groups)) ? $groups : [];
    }

    public function setIdentifier($identifier) : bool
    {
        $this->setData('identifier', $identifier);
    }
}