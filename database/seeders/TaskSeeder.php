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
        // Project 1 Tasks
        // Task 1 - Member 1
        DB::table('tasks')->insert([
            'project_id' => 1,
            'name' => 'Task 1 for Admin',
            'description' => 'This is Task 1 assigned to Admin.',
            'status' => 'completed',
            'due_date' => now()->addDays(15),
            'assigned_to' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 2 - Member 2
        DB::table('tasks')->insert([
            'project_id' => 1,
            'name' => 'Task 2 for John Doe',
            'description' => 'This is Task 2 assigned to John Doe.',
            'status' => 'completed',
            'due_date' => now()->addDays(15),
            'assigned_to' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 3 - Member 3
        DB::table('tasks')->insert([
            'project_id' => 2,
            'name' => 'Task 3 for Jane Doe',
            'description' => 'This is Task 3 assigned to Jane Doe.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 4 - Member 1
        DB::table('tasks')->insert([
            'project_id' => 2,
            'name' => 'Task 4 for Admin',
            'description' => 'This is Task 4 assigned to Admin.',
            'status' => 'completed',
            'due_date' => now()->addDays(15),
            'assigned_to' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 5 - Member 2
        DB::table('tasks')->insert([
            'project_id' => 3,
            'name' => 'Task 5 for John Doe',
            'description' => 'This is Task 5 assigned to John Doe.',
            'status' => 'completed',
            'due_date' => now()->addDays(15),
            'assigned_to' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 6 - Member 3
        DB::table('tasks')->insert([
            'project_id' => 3,
            'name' => 'Task 6 for Jane Doe',
            'description' => 'This is Task 6 assigned to Jane Doe.',
            'status' => 'completed',
            'due_date' => now()->addDays(15),
            'assigned_to' => 3,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Project 2 Tasks
        // Task 7 - Member 1
        DB::table('tasks')->insert([
            'project_id' => 4,
            'name' => 'Task 7 for Admin',
            'description' => 'This is Task 7 assigned to Admin.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 8 - Member 4
        DB::table('tasks')->insert([
            'project_id' => 4,
            'name' => 'Task 8 for Bob Smith',
            'description' => 'This is Task 8 assigned to Bob Smith.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 9 - Member 5
        DB::table('tasks')->insert([
            'project_id' => 5,
            'name' => 'Task 9 for Alice Johnson',
            'description' => 'This is Task 9 assigned to Alice Johnson.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 10 - Member 1
        DB::table('tasks')->insert([
            'project_id' => 5,
            'name' => 'Task 10 for Admin',
            'description' => 'This is Task 10 assigned to Admin.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 11 - Member 4
        DB::table('tasks')->insert([
            'project_id' => 6,
            'name' => 'Task 11 for Bob Smith',
            'description' => 'This is Task 11 assigned to Bob Smith.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 4,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Task 12 - Member 5
        DB::table('tasks')->insert([
            'project_id' => 6,
            'name' => 'Task 12 for Alice Johnson',
            'description' => 'This is Task 12 assigned to Alice Johnson.',
            'status' => 'not started',
            'due_date' => now()->addDays(15),
            'assigned_to' => 5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
