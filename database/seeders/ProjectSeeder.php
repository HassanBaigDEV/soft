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
            'team_id' => 1, // Replace with your organization ID
            'name' => 'Sample Project',
            'description' => 'This is a sample project.',
            'status' => 'not started',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
