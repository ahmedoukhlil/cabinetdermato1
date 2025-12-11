<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$vXwvYv1qVcrCPHBzgsYqyeYUKcQXctO4qRHfXcirS5NrxQJ1GuGru',
                'remember_token' => null,
                'last_name'      => '',
                'login'          => '',
            ],
        ];

        User::insert($users);
    }
}
