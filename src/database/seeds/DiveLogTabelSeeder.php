<?php

use Illuminate\Database\Seeder;

class DiveLogTabelSeeder extends Seeder
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
            'divelog_title' => 'ライセンス',
            'date' => '2018-06-23',
            'point_name' => '串本町和深ビーチ',
            'dive_num' => 1,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-06-21T09:30',
            'finish_time' => '2018-06-21T10:00',
            'start_air' => 200,
            'finish_air' => 50,
            'avg_depth' => 3.0,
            'max_depth' => 5.0,
            'water_temp' => 22,
            'temp' => 23,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 1,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 5,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => 'ライセンス',
            'date' => '2018-06-24',
            'point_name' => '串本町須江白野ビーチ',
            'dive_num' => 2,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-06-21T09:37',
            'finish_time' => '2018-06-21T10:00',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 2.0,
            'max_depth' => 5.0,
            'water_temp' => 22,
            'temp' => 26,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 3,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 5,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => 'ライセンス',
            'date' => '2018-06-24',
            'point_name' => '串本町須江白野ビーチ',
            'dive_num' => 3,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-06-21T12:10',
            'finish_time' => '2018-06-21T12:35',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 4.5,
            'max_depth' => 5.0,
            'water_temp' => 22,
            'temp' => 26,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 3,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 5,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => 'ライセンス',
            'date' => '2018-06-24',
            'point_name' => '串本町須江白野ビーチ',
            'dive_num' => 4,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-06-21T13:30',
            'finish_time' => '2018-06-21T13:50',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 4.4,
            'max_depth' => 5.0,
            'water_temp' => 22,
            'temp' => 26,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 3,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 5,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => '付き添い',
            'date' => '2018-08-04',
            'point_name' => '串本町和深ビーチ',
            'dive_num' => 5,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-08-04T09:55',
            'finish_time' => '2018-08-04T10:21',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 3.3,
            'max_depth' => 5.0,
            'water_temp' => 27,
            'temp' => 34,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 10,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 6,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => '付き添い',
            'date' => '2018-08-05',
            'point_name' => '串本町和深ビーチ',
            'dive_num' => 6,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-08-05T09:40',
            'finish_time' => '2018-08-05T10:20',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 6.8,
            'max_depth' => 10,
            'water_temp' => 27,
            'temp' => 34,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 10,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 6,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

        $param = [
            'user_id' => 1,
            'item_type' => '0',
            'divelog_title' => '付き添い',
            'date' => '2018-08-05',
            'point_name' => '串本町和深ビーチ',
            'dive_num' => 7,
            'shop_name' => 'mic21',
            'entry_type' => 1,
            'start_time' => '2018-08-05T11:00',
            'finish_time' => '2018-08-05T11:40',
            'start_air' => 200,
            'finish_air' => 100,
            'avg_depth' => 6.8,
            'max_depth' => 10,
            'water_temp' => 27,
            'temp' => 34,
            'weather' => 0,
            'wind' => 0,
            'current' => 0,
            'view' => 10,
            'tank_material' => 0,
            'tank_capacity' => 10,
            'suit_type' => 0,
            'suit_size' => 6.0,
            'weight' => 6,
            'map_item' => '',
            'comment' => '',
            'open_range' => '',
            'is_open' => '',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('dive_logs')->insert($param);

    }
}
