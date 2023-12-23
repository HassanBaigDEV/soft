<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            'project_id' => 1, // Replace with your project ID
            'name' => 'Sample Task',
            'description' => 'This is a sample task.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 1, // Replace with your user ID
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
