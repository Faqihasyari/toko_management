<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRoleRepository
{
    public function assignRoleToUser(int $userId, int $roleId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findOrFail($roleId);

        $user->assignRole($role->name);

        return $user;
    }
}
