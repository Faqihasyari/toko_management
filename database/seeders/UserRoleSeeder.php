<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = ['manager', 'keeper', 'customer'];

        $permissions = ['create role', 'edit role', 'delete role', 'view role'];

        foreach ($roles as $roleName) {
            $role =  Role::firstOrCreate(['name' => $roleName]);
        }

        foreach ($permissions as $permissionsName) {
            Permission::firstOrCreate(['name' => $permissionsName]);
        }
    }
}
