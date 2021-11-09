<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'user']);
        $data_role_user = [
            'home',
            'users.index',
            'users.profile',
            'users.edit',
            'users.update',
            'users.show',
            'users.update',
        ];

        $role->givePermissionTo($data_role_user);

        $role = Role::create(['name' => 'admin']);
        $data_role_admin = [
            'home',
            'users.index',
            'users.profile',
            'users.edit',
            'users.update',
            'users.show',
            'users.update',
            'admins.index',
            'admins.user.show',
            'admins.user.edit',
            'admins.user.update',
            'admins.user.delete',
            'admins.user.password.edit',
            'admins.user.password.update',
            'admins.role.index',
            'admins.role.show',
            'admins.role.edit',
            'admins.role.update',
            'admins.role.delete',
            'admins.permission.index',
            'admins.permission.show',
            'admins.permission.edit',
            'admins.permission.update',
            'admins.permission.delete',
        ];
        $role->givePermissionTo($data_role_admin);
    }
}
