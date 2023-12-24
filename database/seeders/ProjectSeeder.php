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
            'team_id' => 1,
            'name' => 'Sample',
            'description' => 'Sample it is',
            'members' => json_encode([1, ['id' => 1, 'name' => 'admin']]),
            'status' => 'cancelled',
            'start_date' => '2023-12-24',
            'end_date' => '2023-12-24',
            'created_at' => '2023-12-24 12:46:14',
        ]);
    }
}
