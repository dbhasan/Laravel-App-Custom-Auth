<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
Use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    private $roles = [
        'Superadmin',
        'Admin',
        'Authority',
        'Manager',
        'Account',
    ];


    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::create(['name' => $role]);
        };

        $this->call([
            UserSeeder::class,
            RightSeeder::class,
        ]);
    }
}
