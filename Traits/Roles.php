<?php

namespace Firmino\UserAcl\Traits;

use App\User;
use Firmino\UserAcl\Facades\Acl;
use Firmino\UserAcl\Http\Role;
use Firmino\UserAcl\Http\RoleUser;
use Illuminate\Support\Collection;

trait Roles {

    /**
     * Get all roles assign to user
     * @return Collection
     */
    public function getRoles () {
        return RoleUser::query()->where('user_id', $this->id)->get()
            ->map(function ($item, $key) {
                return Role::query()->find($item['role_id']);
            });
    }

    /**
     * Assign role to user
     * @param string $slug
     * @return string
     */
    public function assignRole (string $slug) {
        $roleUser = new RoleUser();
        $role = Role::query()->where('slug', $slug)->get()->first();

        if (!$role)
            return 'Role not exists';

        $roleUser->role_id = $role->id;
        $roleUser->user_id = $this->id;

        $roleUser->save();

        return 'Role assign success';
    }

    /**
     * Revoke role user
     * @param string $slug
     * @return string
     */
    public function revokeRole (string $slug) {
        $role = Role::query()->where('slug', $slug)->get()->first();

        if (!$role)
            return 'Role not exists';

        $roleUser = RoleUser::query()->where('role_id', $role->id)
            ->where('user_id', $this->id)->delete();

        if ($roleUser)
            return 'Role revoke success';

        return 'Role revoke fail';
    }

    /**
     * Revoke all roles of user
     */
    public function revokeAllRoles () {
        $roles = $this->getRoles();
        $roles->each(function ($item) {
           $this->revokeRole($item['slug']);
        });
    }

    /**
     * Verify if user was role
     * @param string $slug
     * @return bool
     */
    public function hasRole (string $slug) {
        $roles = $this->getRoles();
        return $roles->where('slug', $slug)->first() ? true : false;
    }
}
