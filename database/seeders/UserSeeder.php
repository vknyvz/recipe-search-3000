<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'john@classicburgers.com',
                'password' => Hash::make('password'), // always hash passwords
            ],
            [
                'name' => 'John Doe',
                'email' => 'marie@bahnmi.com',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'anna@pita.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'sarah@salads.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'mike@melt.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'emily@citrus.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'david@lettucewraps.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'kate@bowls.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'waffle@breakfast.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'volkan@salmon.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'burrito@glutenfree.com',
                'password' => Hash::make('mypassword'),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'plate@breakfast.com',
                'password' => Hash::make('mypassword'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
