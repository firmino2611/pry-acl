## PryAcl

Laravel ACL adds role to user auth.

### Installation

Installation by composer require

```php 
composer require firmino/pry-acl 
```
Installation manually, add in file composer.json

```json
{
    "require": {
        "firmino/pry-acl": "1.0.*"
    }
}
```
### Configuration laravel 5.5+

Laravel's package discovery will take care of integration for you.

### Configuration laravel <5.5

Add the following settings to your app.php file.

```php 
'providers' => array(
    //...
    Firmino\EasyPaginator\Providers\UserAclrServiceProvider::class,
),
```
and add aliases
```php
'Acl' => Firmino\UerAcl\Facades\Acl::class
```
## Working roles 

```php
//...ignore
use Firmino\UserAcl\Traits\Roles;

class User extends Model
{
    use Roles;
//...ignore

```

```php
$user = User::find(1);
$slug = 'admin';
$user->assignRole($slug');

$user->getRoles();

$user->revokeRole($slug);

$user->revokeAllRole();


```

### Blade extensions

Allow viewing of certain content based on authenticated user role.

```php 
@role('admin')
    <h1>I am Admin</h1>
@endrole
```

### Facade
Import Facade ``` Acl ``` 

#### Create roles

```php
/**
    * Create a role
    * @param array $data
    * @return string
*/
Acl::createRole(
    array(
        'name' => 'Admin',
        'slug' => 'admin',
        'description' => ''
    )
)

```

#### Delete Role

```php
/**
    * Delete a role with slug specify
    * @param string $slug
    * @return string
*/
Acl::deleteRole('admin')
```


#### Get Roles

```php
/**
    * Get all roles
    * @return Collection
*/
Acl::roles()
```
