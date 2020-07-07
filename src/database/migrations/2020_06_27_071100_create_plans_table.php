<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('item_type')->default(2);
            $table->text('plan_title');
            $table->dateTime('start');
            $table->dateTime('finish');
            $table->tinyInteger('is_fixed')->default(0);
            $table->text('map_item')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('open_range')->default(1);
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
        Schema::dropIfExists('plans');
    }
}
