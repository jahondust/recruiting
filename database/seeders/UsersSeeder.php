<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'middle_name' => 'Admin',
        ]);

        $user->assignRole(['admin']);

        $user = User::create([
            'name' => 'organization',
            'email' => 'organization@organization.com',
            'password' => bcrypt('123456'),
            'first_name' => 'Organization',
            'last_name' => 'Organization',
            'middle_name' => 'Organization',
        ]);

        $user->assignRole(['organization']);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('123456'),
            'first_name' => 'User',
            'last_name' => 'User',
            'middle_name' => 'User',
        ]);

        $user->assignRole(['user']);
    }
}

