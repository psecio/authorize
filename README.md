# Authorize

A comprehensive authorization library (ACL, RBAC, PBAC)


## Example Usage:

```php
<?php

require_once __DIR__.'/vendor/autoload.php';

use \Psecio\Authorize\Auth;
use \Psecio\Authorize\Builder\Acl;

$allowedList = [
    'user1',
    'user2'
];
$username = 'user1';

// Either through the more general builder
$result = Auth::build('acl', $allowedList)->verify($username);
echo 'Is username in ACL? '.var_export($result, true)."\n";

// Or through the specific type
$acl = Acl::build($allowedList);
var_export($acl->verify($username));


// Or, if you need something more complex, you can fall back on PropAuth
use \Psecio\PropAuth\Policy;

$policy = Policy::instance()->hasIdentifier(['user1', 'user2'], Policy::ANY);
$result = Auth::build('acl', $policy)->verify($user);

?>
```

## Check types

There are several check types that can be performed using the **Authorize** library:

### ACL

```php
$allowedList = [
    'user1',
    'user2'
];
$username = 'user1';

$result = Auth::build('acl', $allowedList)->verify($username); // Returns true
```

### Permission

```php
<?php
class User implements \Psecio\Authorize\Context\SubjectInterface
{
    public function getIdentifier() : string
    {
        return 'user1';
    }

    public function getGroups() : array
    {
        return [];
    }

    public function getPermissions() : array
    {
        return ['perm1'];
    }

    public function setIdentifier($identifier) : bool
    {
        return true;
    }
}

$user = new User();
$result = Auth::build('permission', ['perm1'])->verify($user); // Returns true
?>
```

### Role-based

```php
<?php

class MyGroup implements \Psecio\Authorize\Context\SubjectInterface
{
    protected $name = '';
    protected $permissions = [];

    public function getName()
    {

    }
    public function getPermissions()
    {
        // Fetch the permissions related to the group and return an array 
        // Name sure they implement the PermissionInterface so getName will exist

        $names = [];
        foreach ($permissions as $permission) {
            $names = $permission->getName();
        }
        return $names;
    }
}

class User implements \Psecio\Authorize\Context\SubjectInterface
{
    public function getIdentifier() : string
    {
        return 'user1';
    }

    public function getGroups() : array
    {
        // Fetch the groups as instances of the "MyGroup" class
        // in this case, they're in the $groups array

        $names = [];
        foreach ($groups as $group) {
            $names[] = $group->getName();
        }
    }

    public function getPermissions() : array
    {
        return ['perm1'];
    }

    public function setIdentifier($identifier) : bool
    {
        return true;
    }
}

$user = new User();

// You can pass in either a group name or permission name here
// It will search groups first then permissions inside of those groups

$result = Auth::build('rbac', ['group1'])->verify($user); // Returns true

$result = Auth::build('rbac', ['perm1'])->verify($user); // Returns true
?>
```

### Property-based

The property based evaluation for the `Authorize` library makes use of the [psecio/propauth library](https://github.com/psecio/propauth) for policy-based evaluation using the same interface as the other methods.

For example, to check and see if a user has a `username` property you could use the following:

```php
<?php
$user = new User();
$user->username = 'ccornutt';

$policy = \Psecio\PropAuth\Policy::instance()->hasUsername('ccornutt');
$result = Auth::build('pbac', $policy)->verify($user); // Returns true
?>
```