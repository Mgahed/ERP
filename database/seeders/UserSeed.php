<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('123456789'),
            'role' => 'normal',
        ]);
    }
}
