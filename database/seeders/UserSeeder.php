<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=>"admin",
            "tel"=>"8701123456",
            "email"=>"admin@gmail.com",
            "password"=>bcrypt("password"),
            "role_id"=>Role::ADMIN_ROLE
        ]);
    }
}
