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
            $table->integer('courier_id')->default(0)->nullable();
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->integer('sender_id')->default(0);
            $table->foreign('sender_id')->references('id')->on('users');
            $table->integer('receiver_id')->default(0);
            $table->foreign('receiver_id')->references('id')->on('users');
            $table->integer('sender_address_id')->default(0);
            $table->foreign('sender_address_id')->references('id')->on('addresses');
            $table->integer('receiver_address_id')->default(0);
            $table->foreign('receiver_address_id')->references('id')->on('addresses');
            $table->integer('price')->default(0);
            $table->char('description', 250); //100x20x40 boyutunda 3 kglık 2 kutu
            $table->string('status')->default(0);
            // $table->dateTime('delivered_at');
            $table->softDeletes();
            $table->timestamps();
        });
            \DB::statement('ALTER TABLE tasks AUTO_INCREMENT = 10000;');
            //status
            //0:onay bekliyor
            //1:onaylandı-Kurye Ataması Bekleniyor
            //2:Kurye atandı-Kurye Kabul Etmesi Bekleniyor
            //3:Kurye Kabul etti
            //4:Kurye gönderiyi teslim aldı
            //5:Kurye yola çıktı
            //6:Kurye hedefe vardı
            //7:Gönderi teslim edildi
            //8:Kurye vazgeçti,yeni Kurye Kabul Etmesi Bekleniyor
            //9:İptal edildi
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
