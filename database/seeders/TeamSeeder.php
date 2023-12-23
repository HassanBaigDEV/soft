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
        DB::table('teams')->insert([
            'organization_id' => 1, // Replace with your organization ID
            'team_head' => 1, // Replace with your user ID
            'name' => 'Development Team',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
