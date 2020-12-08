<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_id')->default(0);
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->integer('sender_id')->default(0);
            $table->foreign('sender_id')->references('id')->on('users');
            $table->integer('receiver_id')->default(0);
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->integer('sender_address_id')->default(0);
            $table->foreign('sender_address_id')->references('id')->on('address');
            $table->integer('receiver_address_id')->default(0);
            $table->foreign('receiver_address_id')->references('id')->on('address');
            $table->integer('price')->default(0);
            $table->char('description', 250); //100x20x40 boyutunda 3 kglık 2 kutu
            $table->string('status');
            // $table->dateTime('delivered_at');
            $table->timestamps();
        });
            \DB::statement('ALTER TABLE tasks AUTO_INCREMENT = 1000;');
            //status
            //0:onay bekliyor
            //1:onaylandı
            //2:Kurye atandı
            //3:Kurye Kabul etti
            //4:Kurye yola çıktı
            //5:Kurye hedefe vardı
            //6:Gönderi teslim edildi
            //7:İptal edildi
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}