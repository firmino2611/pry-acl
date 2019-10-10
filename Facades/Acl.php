<?php
namespace Firmino\UserAcl\Facades;
use Illuminate\Support\Facades\Facade;

class Acl extends Facade
{
    protected static function getFacadeAccessor() {
        return 'UserAcl.acl';
    }
}
