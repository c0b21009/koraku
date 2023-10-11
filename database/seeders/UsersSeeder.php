<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'sota',
            'email' => 'c0b210090c@edu.teu.ac.jp',
            'password' => '$2y$10$3hrvkUuAc9zaWv6LJ6xZqem20wKaE9uXlBLczb2wAPNkCbX778mKu',
            'created_at' => '2023-10-11 02:04:51',
            'updated_at' => '2023-10-11 02:04:51',
            'group_id' => '1',
        ]);
    }
}
