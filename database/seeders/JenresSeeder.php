<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class JenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenres')->insert([
            'name' => 'ピクニック',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
