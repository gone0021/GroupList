<?php

use Illuminate\Database\Seeder;

class GroupTabaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'group_name' => '沖縄',
            'group_type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '九州',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '四国',
            'group_type' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '中国',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '近畿',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '東北',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '東海',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '関東',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '北陸',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);

        $param = [
            'group_name' => '北海道',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('groups')->insert($param);
        //
    }
}
