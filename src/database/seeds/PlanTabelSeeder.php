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
            'plan_title' => '沖縄',
            'start' => '2020-09-01T00:00',
            'finish' => '2020-09-03T00:00',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'plan_title' => '温泉',
            'start' => '2020-12-12T00:00',
            'finish' => '2020-12-13T23:59',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '2',
            'plan_title' => '兵庫北部',
            'start' => '2020-11-01T00:00',
            'finish' => '2020-11-03T00:00',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 8,
            'item_type' => '2',
            'plan_title' => 'ファン感謝祭',
            'start' => '2019-11-06T00:00',
            'finish' => '2019-11-09T00:00',
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'plan_title' => '波照間',
            'start' => '2020-11-20T00:00',
            'finish' => '2020-11-25T23:59',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 2,
            'item_type' => '2',
            'plan_title' => '紅葉',
            'start' => '2019-11-02T00:00',
            'finish' => '2019-11-02T23:59',
            'status' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '2',
            'plan_title' => 'ガマ',
            'start' => '2020-08-20T00:00',
            'finish' => '2020-08-20T23:59',
            'status' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('plans')->insert($param);

        //
    }
}
