<?php

use Illuminate\Database\Seeder;

class GroupUserTabaleSeeder extends Seeder
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
            'group_id' => 1,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 1,
            'group_id' => 2,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 1,
            'group_id' => 3,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 1,
            'group_id' => 4,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 1,
            'group_id' => 8,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 2,
            'group_id' => 1,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 2,
            'group_id' => 2,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 2,
            'group_id' => 5,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 2,
            'group_id' => 7,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 2,
            'group_id' => 12,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 5,
            'group_id' => 2,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 5,
            'group_id' => 6,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 5,
            'group_id' => 11,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 5,
            'group_id' => 13,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 8,
            'group_id' => 1,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 8,
            'group_id' => 4,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 8,
            'group_id' => 5,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 8,
            'group_id' => 8,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 8,
            'group_id' => 13,
            'group_admin' => 1,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 3,
            'group_id' => 1,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 6,
            'group_id' => 2,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 7,
            'group_id' => 4,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 10,
            'group_id' => 11,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 9,
            'group_id' => 9,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 4,
            'group_id' => 8,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 5,
            'group_id' => 10,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 11,
            'group_id' => 6,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

        $param = [
            'user_id' => 12,
            'group_id' => 1,
            'group_admin' => 0,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ];
        DB::table('group_user')->insert($param);

    }
}
