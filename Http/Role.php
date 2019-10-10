<?php

namespace Firmino\UserAcl\Http;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed name
 * @property mixed slug
 * @property mixed description
 */
class Role extends Model
{
    protected $table;
    protected $hidden = ['created_at', 'updated_at'];

    public function __construct(array $attributes = [])
    {
        $this->table = config('acl.table_prefix') . 'roles';
        parent::__construct($attributes);
    }

}
