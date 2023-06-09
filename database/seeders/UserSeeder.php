<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(5)->create();
        $data = [
            [
                'first_name' => 'Kim Edward',
                'middle_name' => null,
                'last_name' => 'Ilagan',
                'email' =>  'keilagan@books.gov.ph',
                'username' => 'keilagan',
                'password' => Hash::make('password123**'),
                'role' => 'Admin',
                'is_active' => 1
            ],
            [
                'first_name' => 'Melody Grace',
                'middle_name' => 'G',
                'last_name' => 'Austria',
                'email' =>  'mgaustria@books.gov.ph',
                'username' => 'mgaustria',
                'password' => Hash::make('password123**'),
                'role' => 'Admin',
                'is_active' => 1
            ]
        ];

        return User::insert($data);
    }
}
