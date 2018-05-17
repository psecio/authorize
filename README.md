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