<?php

use Illuminate\Database\Seeder;

class GroupAdminTabaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'group_id' => 1,
            'admin_user_id' => 2,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 1,
            'admin_user_id' => 8,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 4,
            'admin_user_id' => 8,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 2,
            'admin_user_id' => 6,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 5,
            'admin_user_id' => 7,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 3,
            'admin_user_id' =>3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 7,
            'admin_user_id' => 5,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

        $param = [
            'group_id' => 10,
            'admin_user_id' => 9,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_admin')->insert($param);

    }
}
