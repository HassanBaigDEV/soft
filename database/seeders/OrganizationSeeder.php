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
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
