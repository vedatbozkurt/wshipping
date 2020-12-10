<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_district', function (Blueprint $table) {
            $table->id();
            $table->integer('district_id')->unsigned();
            $table->foreign('district_id')->references('id')->on('district')->onDelete('cascade');
            $table->integer('courier_id')->unsigned();
            $table->foreign('courier_id')->references('id')->on('courier')->onDelete('cascade');
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
        Schema::dropIfExists('courier_district');
    }
}
