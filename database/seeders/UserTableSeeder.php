<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create(array(
            'name' => 'Admin',
            'email' => 'admin@.com',
            'password' => bcrypt('12345678')
        ));
    }
}
