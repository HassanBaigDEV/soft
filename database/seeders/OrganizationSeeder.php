<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Organization 1
        DB::table('organizations')->insert([
            'name' => 'Sample Organization 1',
            'owner_id' => 1, // Replace with your user ID
            'invite_code' => \Illuminate\Support\Str::uuid(),
            'members' => json_encode([
                '1' => ['id' => 1, 'name' => 'admin'],
                '2' => ['id' => 2, 'name' => 'John Doe'],
                '3' => ['id' => 3, 'name' => 'Jane Doe'],
                '4' => ['id' => 4, 'name' => 'Bob Smith'],
                '5' => ['id' => 5, 'name' => 'Alice Johnson'],                
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    
        // Organization 2
        DB::table('organizations')->insert([
            'name' => 'Sample Organization 2',
            'owner_id' => 7, // Replace with another user ID
            'invite_code' => \Illuminate\Support\Str::uuid(),
            'members' => json_encode([
                '6' => ['id' => 6, 'name' => 'Michael Davis'],            
                '7' => ['id' => 7, 'name' => 'Emily Wilson'],
                '8' => ['id' => 8, 'name' => 'David Turner'],
            ]),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    
}
