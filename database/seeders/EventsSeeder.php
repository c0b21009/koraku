<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'title' => 'ピクニックへ行こう！',
            'start_time' => ' 2023-10-11 02:04:51',
            'end_time' => ' 2023-10-11 04:04:51',
            'location' => '公園',
            'event_content' => '~~~~~~~~~~~~~~~~~~~~',
            'jenre_id' => '1',
            'group_id' => '1',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('events')->insert([
            'title' => 'UMIへ行こう！',
            'start_time' => ' 2023-10-11 02:04:51',
            'end_time' => ' 2023-10-11 04:04:51',
            'location' => '公園',
            'event_content' => '~~~~~~~~~~~~~~~~~~~~',
            'jenre_id' => '1',
            'group_id' => '1',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
        DB::table('events')->insert([
            'title' => 'yamaへ行こう！',
            'start_time' => ' 2023-10-11 02:04:51',
            'end_time' => ' 2023-10-11 04:04:51',
            'location' => '公園',
            'event_content' => '~~~~~~~~~~~~~~~~~~~~',
            'jenre_id' => '1',
            'group_id' => '1',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
