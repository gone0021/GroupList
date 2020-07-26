<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiveLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dive_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('item_type')->default(0);
            $table->text('divelog_title');
            $table->date('date');
            $table->text('point_name');
            $table->integer('dive_num')->unique();
            $table->text('shop_name');
            $table->tinyInteger('entry_type')->default(0);
            $table->time('start_time');
            $table->time('finish_time');
            $table->integer('start_air')->default(200);
            $table->integer('finish_air');
            $table->double('avg_depth');
            $table->double('max_depth');
            $table->integer('water_temp');
            $table->integer('temp');
            $table->tinyInteger('weather')->default(0);
            $table->tinyInteger('wind')->default(0);
            $table->tinyInteger('current')->default(0);
            $table->Integer('view');
            $table->tinyInteger('tank_material')->default(0);
            $table->Integer('tank_capacity')->default(10);
            $table->tinyInteger('suit_type')->default(0);
            $table->double('suit_size');
            $table->Integer('weight');
            $table->text('map_item')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('open_range')->default(0);
            $table->tinyInteger('is_open')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dive_logs');
    }
}
