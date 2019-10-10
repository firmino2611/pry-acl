<?php

namespace Firmino\UserAcl\Http;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table;
    protected $hidden = ['created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        $this->table = config('acl.table_prefix') . 'role_users';
        parent::__construct($attributes);
    }

}
