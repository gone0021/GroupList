<?php

use Illuminate\Database\Seeder;

class TripTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'trip_title' => '沖縄',
            'date' => '2020-09-01',
            'point_name' => '本島',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '1',
            'trip_title' => '温泉',
            'date' => '2020-12-12',
            'point_name' => '城崎温泉',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '1',
            'trip_title' => '兵庫北部',
            'date' => '2019-11-01',
            'point_name' => '竹田城跡、城崎',
            'is_went' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 8,
            'item_type' => '0',
            'trip_title' => 'ファン感謝祭',
            'date' => '2019-11-06',
            'point_name' => '座間味',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'trip_title' => '波照間',
            'date' => '2020-11-30',
            'point_name' => '石垣',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '2',
            'trip_title' => '紅葉',
            'date' => '2020-11-01',
            'point_name' => '京都',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'trip_title' => 'ガマ',
            'date' => '2020-08-12',
            'point_name' => '和歌山',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('trips')->insert($param);

        //
    }
}
