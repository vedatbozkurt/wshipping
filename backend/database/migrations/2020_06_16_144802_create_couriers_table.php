<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->default(0);
            $table->foreign('branch_id')->references('id')->on('branch');
            $table->string('name');
            $table->string('image');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('vehicle');
            $table->string('plate');
            $table->string('color');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('couriers');
    }
}
