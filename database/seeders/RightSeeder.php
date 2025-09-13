<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rights')->insert([
            // User
            ['id' => 1, 'name' => 'User.view', 'module' => 'User'],
            ['id' => 2, 'name' => 'User.create', 'module' => 'User'],
            ['id' => 3, 'name' => 'User.edit', 'module' => 'User'],
            ['id' => 4, 'name' => 'User.delete', 'module' => 'User'],

            // Role
            ['id' => 5, 'name' => 'Role.view', 'module' => 'Role'],
            ['id' => 6, 'name' => 'Role.create', 'module' => 'Role'],
            ['id' => 7, 'name' => 'Role.edit', 'module' => 'Role'],
            ['id' => 8, 'name' => 'Role.delete', 'module' => 'Role'],

            // Variation
            ['id' => 25, 'name' => 'Variation.view', 'module' => 'Variation'],
            ['id' => 26, 'name' => 'Variation.create', 'module' => 'Variation'],
            ['id' => 27, 'name' => 'Variation.edit', 'module' => 'Variation'],
            ['id' => 28, 'name' => 'Variation.delete', 'module' => 'Variation'],

            // Entries
            ['id' => 29, 'name' => 'Entries.view', 'module' => 'Entries'],
            ['id' => 30, 'name' => 'Entries.create', 'module' => 'Entries'],
            ['id' => 31, 'name' => 'Entries.edit', 'module' => 'Entries'],
            ['id' => 32, 'name' => 'Entries.delete', 'module' => 'Entries'],

            // Exit
            ['id' => 33, 'name' => 'Exit.view', 'module' => 'Exit'],
            ['id' => 34, 'name' => 'Exit.create', 'module' => 'Exit'],
            ['id' => 35, 'name' => 'Exit.edit', 'module' => 'Exit'],
            ['id' => 36, 'name' => 'Exit.delete', 'module' => 'Exit'],

            // Collection
            ['id' => 37, 'name' => 'Collection.view', 'module' => 'Collection'],
            ['id' => 38, 'name' => 'Collection.create', 'module' => 'Collection'],
            ['id' => 39, 'name' => 'Collection.edit', 'module' => 'Collection'],
            ['id' => 40, 'name' => 'Collection.delete', 'module' => 'Collection'],

            // Loan
            ['id' => 41, 'name' => 'Loan.view', 'module' => 'Loan'],
            ['id' => 42, 'name' => 'Loan.create', 'module' => 'Loan'],
            ['id' => 43, 'name' => 'Loan.edit', 'module' => 'Loan'],
            ['id' => 44, 'name' => 'Loan.delete', 'module' => 'Loan'],

            // Accounts
            ['id' => 45, 'name' => 'Accounts.view', 'module' => 'Accounts'],
            ['id' => 46, 'name' => 'Accounts.create', 'module' => 'Accounts'],
            ['id' => 47, 'name' => 'Accounts.edit', 'module' => 'Accounts'],
            ['id' => 48, 'name' => 'Accounts.delete', 'module' => 'Accounts'],

            // Report
            ['id' => 49, 'name' => 'Report.view', 'module' => 'Report'],
            ['id' => 50, 'name' => 'Report.create', 'module' => 'Report'],
            ['id' => 51, 'name' => 'Report.edit', 'module' => 'Report'],
            ['id' => 52, 'name' => 'Report.delete', 'module' => 'Report'],

            // Password
            ['id' => 53, 'name' => 'Password.view', 'module' => 'Password'],
            ['id' => 54, 'name' => 'Password.create', 'module' => 'Password'],
            ['id' => 55, 'name' => 'Password.edit', 'module' => 'Password'],
            ['id' => 56, 'name' => 'Password.delete', 'module' => 'Password'],
        ]);

    }

}
