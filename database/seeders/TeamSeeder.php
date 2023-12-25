<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Team 1
        DB::table('teams')->insert([
            'organization_id' => 1, // Replace with your organization ID
            'team_head' => 1, // Replace with your user ID
            'name' => 'Development Team 1',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '2' => ['id' => 2, 'name' => 'John Doe'],
                '3' => ['id' => 3, 'name' => 'Jane Doe'],
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Team 2
        DB::table('teams')->insert([
            'organization_id' => 1, // Replace with your organization ID
            'team_head' => 2, // Replace with your user ID
            'name' => 'Development Team 2',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '4' => ['id' => 4, 'name' => 'Bob Smith'],
                '5' => ['id' => 5, 'name' => 'Alice Johnson'],
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Team 3
        DB::table('teams')->insert([
            'organization_id' => 2, // Replace with your organization ID
            'team_head' => 3, // Replace with your user ID
            'name' => 'Development Team 3',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '6' => ['id' => 6, 'name' => 'Michael Davis'],
                '7' => ['id' => 7, 'name' => 'Emily Wilson'],
                '8' => ['id' => 8, 'name' => 'David Turner'],
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
