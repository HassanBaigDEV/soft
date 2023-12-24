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
        DB::table('organizations')->insert([
            'name' => 'Sample Organization',
            'owner_id' => 1,
            //generate uuid for invite code
            'invite_code' => \Illuminate\Support\Str::uuid(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
