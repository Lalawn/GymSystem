<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [[
            'name' => 'John doe',
            'email' => 'test@gmail.com',
            'password' => Hash::make('Test'),
        ],
            [
                'name' => 'Trainer',
                'email' => 'trainer@gmail.com',
                'password' => Hash::make('Test'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('Test'),
            ]
        ];

        $roles = [
            'admin@gmail.com' => 1,
            'trainer@gmail.com' => 3,
            'test@gmail.com' => 2
        ];
        foreach($users as $user) {
            User::firstOrCreate($user);

        }
        foreach ($users as $user) {
            (new User)->where('email', '=', $user['email'])->first()->roles()->attach($roles[$user['email']]);
        }
    }
}
