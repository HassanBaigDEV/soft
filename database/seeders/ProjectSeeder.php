<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'id' => 1,
            'team_id' => 1, // Replace with your team ID
            'name' => 'Sample Project 1',
            'description' => 'Sample project description 1',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '2' => ['id' => 2, 'name' => 'John Doe'],
            ]),
            'status' => 'completed',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);

        // Project 2
        DB::table('projects')->insert([
            'id' => 2,
            'team_id' => 1, // Replace with your team ID
            'name' => 'Sample Project 2',
            'description' => 'Sample project description 2',
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '3' => ['id' => 3, 'name' => 'Jane Doe'],
            ]),
            'status' => 'in progress',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);
            // Project 3
        DB::table('projects')->insert([
            'id' => 3,
            'team_id' => 2, // Replace with your team ID
            'name' => 'Sample Project 3',
            'description' => 'Sample project description 3',
            'members' => json_encode([
                '4' => ['id' => 4, 'name' => 'Bob Smith'],
                '5' => ['id' => 5, 'name' => 'Alice Johnson'],
            ]),
            'status' => 'in progress',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);

        // Project 4
        DB::table('projects')->insert([
            'id' => 4,
            'team_id' => 3, // Replace with your team ID
            'name' => 'Sample Project 4',
            'description' => 'Sample project description 4',
            'members' => json_encode([
                '7' => ['id' => 7, 'name' => 'Emily Wilson'],
                '8' => ['id' => 8, 'name' => 'David Turner'],
            ]),
            'status' => 'in progress',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);

        // Project 5
        DB::table('projects')->insert([
            'id' => 5,
            'team_id' => 3, // Replace with your team ID
            'name' => 'Sample Project 4',
            'description' => 'Sample project description 4',
            'members' => json_encode([
                '6' => ['id' => 6, 'name' => 'Michael Davis'],
                '7' => ['id' => 7, 'name' => 'Emily Wilson'],
            ]),
            'status' => 'in progress',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);
    }
}
