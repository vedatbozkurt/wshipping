<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id')->default(0);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('district_id')->default(0);
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('branches');
    }
}
