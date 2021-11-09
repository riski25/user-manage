<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'home']);
        Permission::create(['name' => 'users.index']);
        Permission::create(['name' => 'users.profile']);
        Permission::create(['name' => 'users.edit']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.show']);
        Permission::create(['name' => 'admins.index']);
        Permission::create(['name' => 'admins.user.show']);
        Permission::create(['name' => 'admins.user.edit']);
        Permission::create(['name' => 'admins.user.update']);
        Permission::create(['name' => 'admins.user.delete']);
        Permission::create(['name' => 'admins.user.password.edit']);
        Permission::create(['name' => 'admins.user.password.update']);
        Permission::create(['name' => 'admins.role.index']);
        Permission::create(['name' => 'admins.role.show']);
        Permission::create(['name' => 'admins.role.edit']);
        Permission::create(['name' => 'admins.role.update']);
        Permission::create(['name' => 'admins.role.delete']);
        Permission::create(['name' => 'admins.permission.index']);
        Permission::create(['name' => 'admins.permission.show']);
        Permission::create(['name' => 'admins.permission.edit']);
        Permission::create(['name' => 'admins.permission.update']);
        Permission::create(['name' => 'admins.permission.delete']);
    }
}
