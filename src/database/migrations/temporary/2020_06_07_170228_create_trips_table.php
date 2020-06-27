<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('trip_title');
            $table->date('date');
            $table->string('point_name');
            $table->tinyInteger('is_went')->default(0);
            $table->text('map_item')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('open_rage')->default(2);
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
        Schema::dropIfExists('trips');
    }
}
