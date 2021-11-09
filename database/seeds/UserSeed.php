<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin super',
            'email' => 'superadmin@gmail.com',
            'alamat' => 'surabaya',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('admin');

        $user = User::create([
            'name' => 'User role',
            'email' => 'userrole@gmail.com',
            'alamat' => 'surabaya',
            'password' => bcrypt('password')
        ]);
        $user->assignRole('user');
    }
}
