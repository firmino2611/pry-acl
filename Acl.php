<?php

namespace Firmino\UserAcl;

use Firmino\UserAcl\Http\Role;
use Illuminate\Database\Eloquent\Collection;

class Acl {

    /**
     * Create a role
     * @param array $data
     * @return string
     */
    public function createRole (array $data) {
        if (Role::query()->where('slug', $data['slug'])->get()->first())
            return 'Slug exists';

        $role = new Role();
        $role->name = $data['name'];
        $role->slug = $data['slug'];
        $role->description = $data['description'] ?? '';
        $role->save();

        return 'Created success';
    }

    /**
     * Delete a role with slug specify
     * @param string $slug
     * @return string
     */
    public function deleteRole (string $slug) {
        $result = Role::query()->where('slug', $slug)->delete();
        if ($result)
            return 'Deleted success';

        return 'Delete fail';
    }

    /**
     * Get all roles
     * @return Role[]|Collection
     */
    public function roles () {
        return Role::all();
    }
}
