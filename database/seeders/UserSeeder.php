<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        // Seeder for Admin User
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@softui.com',
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 1
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password123'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 2
        DB::table('users')->insert([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'password' => Hash::make('password456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 3
        DB::table('users')->insert([
            'name' => 'Bob Smith',
            'email' => 'bob.smith@example.com',
            'password' => Hash::make('password789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 4
        DB::table('users')->insert([
            'name' => 'Alice Johnson',
            'email' => 'alice.johnson@example.com',
            'password' => Hash::make('passwordabc'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 5
        DB::table('users')->insert([
            'name' => 'Michael Davis',
            'email' => 'michael.davis@example.com',
            'password' => Hash::make('passworddef'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 6
        DB::table('users')->insert([
            'name' => 'Emily Wilson',
            'email' => 'emily.wilson@example.com',
            'password' => Hash::make('passwordghi'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 7
        DB::table('users')->insert([
            'name' => 'David Turner',
            'email' => 'david.turner@example.com',
            'password' => Hash::make('passwordjkl'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 8
        DB::table('users')->insert([
            'name' => 'Sophia Carter',
            'email' => 'sophia.carter@example.com',
            'password' => Hash::make('passwordmno'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 9
        DB::table('users')->insert([
            'name' => 'Daniel White',
            'email' => 'daniel.white@example.com',
            'password' => Hash::make('passwordpqr'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Seeder for Regular User 10
        DB::table('users')->insert([
            'name' => 'Olivia Brown',
            'email' => 'olivia.brown@example.com',
            'password' => Hash::make('passwordstu'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
