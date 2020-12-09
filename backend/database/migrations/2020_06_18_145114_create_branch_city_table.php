<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_city', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade');
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
        Schema::dropIfExists('branch_city');
    }
}
