<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
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
                'id' => 1,
                'name' => 'Super Admin',
                'role_id' => '1',
                'email' => 'superadmin@gmail.com',
                'phone' => '01700000001',
                'password' => Hash::make('12345678'),
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'role_id' => '2',
                'email' => 'admin@gmail.com',
                'phone' => '01700000002',
                'password' => Hash::make('12345678'),
            ],

            [
                'id' => 3,
                'name' => 'Authority',
                'role_id' => '3',
                'email' => 'authority@gmail.com',
                'phone' => '01700000003',
                'password' => Hash::make('12345678'),
            ],

            [
                'id' => 4,
                'name' => 'Manager',
                'role_id' => '4',
                'email' => 'manager@gmail.com',
                'phone' => '01700000004',
                'password' => Hash::make('12345678'),
            ],
            [
                'id' => 5,
                'name' => 'Account',
                'role_id' => '5',
                'email' => 'account@gmail.com',
                'phone' => '01700000005',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $user) {

            $user = User::updateOrCreate(
                [
                    'id' => $user['id'],
                    'role_id' => $user['role_id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone' => $user['phone'],
                    'password' => $user['password'],
                ]
            );
        }
    }
}
