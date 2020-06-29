<?php

use Illuminate\Database\Seeder;

class PlanTabelSeeder extends Seeder
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
            'item_type' => '2',
            'trip_title' => '沖縄',
            'start' => '2020-09-01 00:00',
            'finish' => '2020-09-03 00:00',
            'is_fixed' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'trip_title' => '温泉',
            'start' => '2020-12-12 00:00',
            'finish' => '2020-12-13 23:59',
            'is_fixed' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '2',
            'trip_title' => '兵庫北部',
            'start' => '2020-11-01 00:00',
            'finish' => '2020-11-03 00:00',
            'is_fixed' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 8,
            'item_type' => '2',
            'trip_title' => 'ファン感謝祭',
            'start' => '2019-11-06 00:00',
            'finish' => '2019-11-09 00:00',
            'is_fixed' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'trip_title' => '波照間',
            'start' => '2020-11-20 00:00',
            'finish' => '2020-11-25 23:59',
            'point_name' => '石垣',
            'is_fixed' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '2',
            'trip_title' => '紅葉',
            'start' => '2019-11-02 00:00',
            'finish' => '2019-11-02 23:59',
            'is_fixed' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'trip_title' => 'ガマ',
            'start' => '2020-08-20 00:00',
            'start' => '2020-08-20 23:59',
            'point_name' => '和歌山',
            'is_fixed' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        //
    }
}
