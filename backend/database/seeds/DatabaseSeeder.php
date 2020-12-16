<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //gönderici
        \App\Address::create([
            'id' => 1,
            'user_id' => 1,
            'city_id' => 35,
            'district_id' => 184,
            'name' => 'My address',
            'description' => 'okulun karşısında',
            'default' => 0,
        ]);

        //alıcı
        \App\Address::create([
            'id' => 2,
            'user_id' => 1,
            'city_id' => 35,
            'district_id' => 173,
            'name' => 'My address',
            'description' => 'okulun diğer karşısında',
            'default' => 0,
        ]);

        //add sample user admin
        \App\Admin::create([
            'id' => 1,
            'name' => 'John Doe',
            'status' => 1,
            'email' => 'a@a.com',
            'password' => bcrypt('123'),
        ]);


        //ege şubesi 1. il izmir
        DB::table('branch_city')->insert([
            'id' => 1,
            'city_id' => 35,
            'branch_id' => 1,
        ]);

        //ege şubesi 2. il manisa
        DB::table('branch_city')->insert([
            'id' => 2,
            'city_id' => 45,
            'branch_id' => 1,
        ]);

        //şubenin ilçesi bornova
        DB::table('branch_district')->insert([
            'id' => 1,
            'district_id' => 173,
            'branch_id' => 1,
        ]);

        //şubenin ilçesi buca
        DB::table('branch_district')->insert([
            'id' => 2,
            'district_id' => 184,
            'branch_id' => 1,
        ]);

        //şubenin ilçesi demirci
        DB::table('branch_district')->insert([
            'id' => 3,
            'district_id' => 276,
            'branch_id' => 1,
        ]);

        //şubenin ilçesi salihli
        DB::table('branch_district')->insert([
            'id' => 4,
            'district_id' => 757,
            'branch_id' => 1,
        ]);

//add sample branch
        \App\Branch::create([
            'id' => 1,
            'name' => 'Ege Şubesi',
            'phone' => '02322758575',
            'email' => 'b@b.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);


        DB::table('city_courier')->insert([
            'id' => 1,
            'city_id' => 35,
            'courier_id' => 1,
        ]);

        DB::table('city_courier')->insert([
            'id' => 2,
            'city_id' => 45,
            'courier_id' => 1,
        ]);

        //kuryenin ilçesi bornova
        DB::table('courier_district')->insert([
            'id' => 1,
            'district_id' => 173,
            'courier_id' => 1,
        ]);

        //kuryenin ilçesi buca
        DB::table('courier_district')->insert([
            'id' => 2,
            'district_id' => 184,
            'courier_id' => 1,
        ]);

        //kuryenin ilçesi demirci
        DB::table('courier_district')->insert([
            'id' => 3,
            'district_id' => 276,
            'courier_id' => 1,
        ]);

        //kuryenin ilçesi salihli
        DB::table('courier_district')->insert([
            'id' => 4,
            'district_id' => 757,
            'courier_id' => 1,
        ]);

//add sample courier
        \App\Courier::create([
            'id' => 1,
            'name' => 'Kurye New',
            'image' => 'c.png',
            'phone' => '02125871212',
            'email' => 'c@c.com',
            'password' => bcrypt('123'),
            'vehicle' => 'car',
            'plate' => '35 cc 135',
            'color' => 'red',
            'status' => 1,
        ]);

      \App\Task::create([
            'id' => 1,
            'courier_id' => 1,
            'sender_id' => 1,
            'receiver_id' => 2,
            'sender_address_id' => 1,
            'receiver_address_id' => 2,
            'price' => 154,
            'description' => 'imza için evrak gönderilecek',
            'status' => 1,
        ]);

      \App\User::create([
            'id' => 1,
            'name' => 'Joe Doe',
            'image' => 'joe.png',
            'phone' => '05511254152',
            'email' => 'u@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);

      \App\User::create([
            'id' => 2,
            'name' => 'Jane Doe',
            'image' => 'jane.png',
            'phone' => '05553214433',
            'email' => 'u2@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
    }
}
