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
        //add sample  admin
        \App\Admin::create([
            'id' => 1,
            'name' => 'John Doe',
            'status' => 1,
            'email' => 'a@a.com',
            'password' => bcrypt('123'),
        ]);
        //cities
        //city 1
        \App\City::create([
            'id' => 6,
            'name' => 'Ankara',
        ]);
        //city 2
        \App\City::create([
            'id' => 34,
            'name' => 'Ankara',
        ]);
        //city 3
        \App\City::create([
            'id' => 35,
            'name' => 'Ankara',
        ]);
         //il ilçeleri
         //city 1 district 1
        \App\District::create([
            'id' => 216,
            'name' => 'Çankaya',
            'city_id' => 6,
        ]);
        //city 1 district 2
        \App\District::create([
            'id' => 359,
            'name' => 'Etimesgut',
            'city_id' => 6,
        ]);
        //city 1 district 3
        \App\District::create([
            'id' => 646,
            'name' => 'Mamak',
            'city_id' => 6,
        ]);
        //city 2 district 1
        \App\District::create([
            'id' => 110,
            'name' => 'Bağcılar',
            'city_id' => 34,
        ]);
        //city 2 district 2
        \App\District::create([
            'id' => 155,
            'name' => 'Beyoğlu',
            'city_id' => 34,
        ]);
        //city 2 district 3
        \App\District::create([
            'id' => 509,
            'name' => 'Kadıköy',
            'city_id' => 34,
        ]);
        //city 3 district 1
        \App\District::create([
            'id' => 184,
            'name' => 'Buca',
            'city_id' => 35,
        ]);
        //city 3 district 2
        \App\District::create([
            'id' => 173,
            'name' => 'Bornova',
            'city_id' => 35,
        ]);
        //city 3 district 3
        \App\District::create([
            'id' => 375,
            'name' => 'Gaziemir',
            'city_id' => 35,
        ]);
        //city 3 district 4
        \App\District::create([
            'id' => 551,
            'name' => 'Karşıyaka',
            'city_id' => 35,
        ]);
        //şubeler
        //branch 1
        \App\Branch::create([
            'id' => 1,
            'name' => 'Ankara Şubesi',
            'phone' => '02322758575',
            'email' => 'b1@b.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //branch 2
        \App\Branch::create([
            'id' => 2,
            'name' => 'İstanbul Şubesi',
            'phone' => '02322758575',
            'email' => 'b2@b.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //branch 3
        \App\Branch::create([
            'id' => 3,
            'name' => 'İzmir Şubesi',
            'phone' => '02322758575',
            'email' => 'b3@b.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //branch 4
        \App\Branch::create([
            'id' => 4,
            'name' => 'İstanbul İzmir Şubesi',
            'phone' => '02322758575',
            'email' => 'b4@b.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //şube illeri
        //1. şube 1. il
        DB::table('branch_city')->insert([
            'id' => 1,
            'city_id' => 6,
            'branch_id' => 1,
        ]);
        //2. şube 1. il
        DB::table('branch_city')->insert([
            'id' => 2,
            'city_id' => 34,
            'branch_id' => 2,
        ]);
        //3. şube 1. il
        DB::table('branch_city')->insert([
            'id' => 3,
            'city_id' => 35,
            'branch_id' => 3,
        ]);
        //3. şube 1. il
        DB::table('branch_city')->insert([
            'id' => 4,
            'city_id' => 34,
            'branch_id' => 4,
        ]);
        //3. şube 2. il
        DB::table('branch_city')->insert([
            'id' => 5,
            'city_id' => 35,
            'branch_id' => 4,
        ]);
        //şube ilçeleri
        //1.şubenin 1.ilçesi
        DB::table('branch_district')->insert([
            'id' => 1,
            'district_id' => 216,
            'branch_id' => 1,
        ]);
        //1.şubenin 2.ilçesi
        DB::table('branch_district')->insert([
            'id' => 2,
            'district_id' => 359,
            'branch_id' => 1,
        ]);
        //1.şubenin 3.ilçesi
        DB::table('branch_district')->insert([
            'id' => 3,
            'district_id' => 646,
            'branch_id' => 1,
        ]);
        //2.şubenin 1.ilçesi
        DB::table('branch_district')->insert([
            'id' => 4,
            'district_id' => 110,
            'branch_id' => 2,
        ]);
        //2.şubenin 2.ilçesi
        DB::table('branch_district')->insert([
            'id' => 5,
            'district_id' => 155,
            'branch_id' => 2,
        ]);
        //2.şubenin 3.ilçesi
        DB::table('branch_district')->insert([
            'id' => 6,
            'district_id' => 509,
            'branch_id' => 2,
        ]);
        //3.şubenin 1.ilçesi
        DB::table('branch_district')->insert([
            'id' => 7,
            'district_id' => 184,
            'branch_id' => 3,
        ]);
        //3.şubenin 2.ilçesi
        DB::table('branch_district')->insert([
            'id' => 8,
            'district_id' => 173,
            'branch_id' => 3,
        ]);
        //3.şubenin 3.ilçesi
        DB::table('branch_district')->insert([
            'id' => 9,
            'district_id' => 375,
            'branch_id' => 3,
        ]);
        //3.şubenin 4.ilçesi
        DB::table('branch_district')->insert([
            'id' => 10,
            'district_id' => 551,
            'branch_id' => 3,
        ]);

        //4.şubenin 1.ilçesi
        DB::table('branch_district')->insert([
            'id' => 11,
            'district_id' => 110,
            'branch_id' => 4,
        ]);
        //4.şubenin 2.ilçesi
        DB::table('branch_district')->insert([
            'id' => 12,
            'district_id' => 155,
            'branch_id' => 4,
        ]);
        //4.şubenin 3.ilçesi
        DB::table('branch_district')->insert([
            'id' => 13,
            'district_id' => 173,
            'branch_id' => 4,
        ]);
        //4.şubenin 4.ilçesi
        DB::table('branch_district')->insert([
            'id' => 14,
            'district_id' => 184,
            'branch_id' => 4,
        ]);
        //4.şubenin 5.ilçesi
        DB::table('branch_district')->insert([
            'id' => 15,
            'district_id' => 375,
            'branch_id' => 4,
        ]);
        //4.şubenin 6.ilçesi
        DB::table('branch_district')->insert([
            'id' => 16,
            'district_id' => 509,
            'branch_id' => 4,
        ]);
        //4.şubenin 7.ilçesi
        DB::table('branch_district')->insert([
            'id' => 17,
            'district_id' => 551,
            'branch_id' => 4,
        ]);
        //courier
        //courier 1
        \App\Courier::create([
            'id' => 1,
            'name' => 'courier one',
            'image' => 'c.png',
            'phone' => '02125871212',
            'email' => 'c1@c.com',
            'password' => bcrypt('123'),
            'vehicle' => 'car',
            'plate' => '35 cc 135',
            'color' => 'red',
            'status' => 1,
        ]);
        //courier 2
        \App\Courier::create([
            'id' => 2,
            'name' => 'courier two',
            'image' => 'c.png',
            'phone' => '02125871212',
            'email' => 'c2@c.com',
            'password' => bcrypt('123'),
            'vehicle' => 'car',
            'plate' => '35 cc 135',
            'color' => 'red',
            'status' => 1,
        ]);
        //courier 3
        \App\Courier::create([
            'id' => 3,
            'name' => 'courier three',
            'image' => 'c.png',
            'phone' => '02125871212',
            'email' => 'c3@c.com',
            'password' => bcrypt('123'),
            'vehicle' => 'car',
            'plate' => '35 cc 135',
            'color' => 'red',
            'status' => 1,
        ]);
        //kuryenin illeri
        //1. kuryenin 1. ili
        DB::table('city_courier')->insert([
            'id' => 1,
            'city_id' => 6,
            'courier_id' => 1,
        ]);
        //2. kuryenin 1. ili
        DB::table('city_courier')->insert([
            'id' => 2,
            'city_id' => 34,
            'courier_id' => 2,
        ]);
        //3. kuryenin 1. ili
        DB::table('city_courier')->insert([
            'id' => 3,
            'city_id' => 34,
            'courier_id' => 3,
        ]);
        //3. kuryenin 2. ili
        DB::table('city_courier')->insert([
            'id' => 4,
            'city_id' => 35,
            'courier_id' => 3,
        ]);

        //kuryelerin ilçeleri
        //1. kuryenin 1. ilçesi
        DB::table('courier_district')->insert([
            'id' => 1,
            'district_id' => 216,
            'courier_id' => 1,
        ]);
        //1. kuryenin 2. ilçesi
        DB::table('courier_district')->insert([
            'id' => 2,
            'district_id' => 359,
            'courier_id' => 1,
        ]);
        //1. kuryenin 3. ilçesi
        DB::table('courier_district')->insert([
            'id' => 3,
            'district_id' => 646,
            'courier_id' => 1,
        ]);
        //2. kuryenin 1. ilçesi
        DB::table('courier_district')->insert([
            'id' => 4,
            'district_id' => 110,
            'courier_id' => 2,
        ]);
        //2. kuryenin 2. ilçesi
        DB::table('courier_district')->insert([
            'id' => 5,
            'district_id' => 155,
            'courier_id' => 2,
        ]);
        //2. kuryenin 3. ilçesi
        DB::table('courier_district')->insert([
            'id' => 6,
            'district_id' => 509,
            'courier_id' => 2,
        ]);
        //3. kuryenin 1. ilçesi
        DB::table('courier_district')->insert([
            'id' => 7,
            'district_id' => 110,
            'courier_id' => 3,
        ]);
        //3. kuryenin 2. ilçesi
        DB::table('courier_district')->insert([
            'id' => 8,
            'district_id' => 155,
            'courier_id' => 3,
        ]);
        //3. kuryenin 3. ilçesi
        DB::table('courier_district')->insert([
            'id' => 9,
            'district_id' => 173,
            'courier_id' => 3,
        ]);
        //3. kuryenin 4. ilçesi
        DB::table('courier_district')->insert([
            'id' => 10,
            'district_id' => 184,
            'courier_id' => 3,
        ]);
        //3. kuryenin 5. ilçesi
        DB::table('courier_district')->insert([
            'id' => 11,
            'district_id' => 375,
            'courier_id' => 3,
        ]);
        //3. kuryenin 6. ilçesi
        DB::table('courier_district')->insert([
            'id' => 12,
            'district_id' => 509,
            'courier_id' => 3,
        ]);
        //3. kuryenin 7. ilçesi
        DB::table('courier_district')->insert([
            'id' => 13,
            'district_id' => 551,
            'courier_id' => 3,
        ]);
        //users
        //user 1
        \App\User::create([
            'id' => 1,
            'name' => 'Joe Doe',
            'image' => 'joe.png',
            'phone' => '05511254152',
            'email' => 'u1@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //user 2
        \App\User::create([
            'id' => 2,
            'name' => 'Jane Doe',
            'image' => 'jane.png',
            'phone' => '05553214433',
            'email' => 'u2@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //user 3
        \App\User::create([
            'id' => 3,
            'name' => 'Jack Doe',
            'image' => 'Jack.png',
            'phone' => '05511254152',
            'email' => 'u3@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //user 4
        \App\User::create([
            'id' => 4,
            'name' => 'Michale Doe',
            'image' => 'Michale.png',
            'phone' => '05553214433',
            'email' => 'u4@u.com',
            'password' => bcrypt('123'),
            'status' => 1,
        ]);
        //addressler
        //1. user 1.adres
        \App\Address::create([
            'id' => 1,
            'user_id' => 1,
            'city_id' => 34,
            'district_id' => 110,
            'name' => 'address1',
            'description' => '1. user 1.adres',
            'default' => 0,
        ]);
        //1. user 2.adres
        \App\Address::create([
            'id' => 2,
            'user_id' => 1,
            'city_id' => 35,
            'district_id' => 184,
            'name' => 'address2',
            'description' => '1. user 2.adres',
            'default' => 0,
        ]);
        //1. user 3.adres
        \App\Address::create([
            'id' => 3,
            'user_id' => 1,
            'city_id' => 6,
            'district_id' => 359,
            'name' => 'address3',
            'description' => '1. user 3.adres',
            'default' => 0,
        ]);
        //2. user 1.adres
        \App\Address::create([
            'id' => 4,
            'user_id' => 2,
            'city_id' => 6,
            'district_id' => 216,
            'name' => 'address1',
            'description' => '2. user 1.adres',
            'default' => 0,
        ]);
        //2. user 2.adres
        \App\Address::create([
            'id' => 5,
            'user_id' => 2,
            'city_id' => 34,
            'district_id' => 509,
            'name' => 'address2',
            'description' => '2. user 2.adres',
            'default' => 0,
        ]);
        //2. user 3.adres
        \App\Address::create([
            'id' => 6,
            'user_id' => 2,
            'city_id' => 35,
            'district_id' => 551,
            'name' => 'address3',
            'description' => '2. user 3.adres',
            'default' => 0,
        ]);
        //3. user 1.adres
        \App\Address::create([
            'id' => 7,
            'user_id' => 3,
            'city_id' => 6,
            'district_id' => 646,
            'name' => 'address1',
            'description' => '3. user 1.adres',
            'default' => 0,
        ]);
        //3. user 2.adres
        \App\Address::create([
            'id' => 8,
            'user_id' => 3,
            'city_id' => 35,
            'district_id' => 173,
            'name' => 'address2',
            'description' => '3. user 2.adres',
            'default' => 0,
        ]);
        //3. user 3.adres
        \App\Address::create([
            'id' => 9,
            'user_id' => 3,
            'city_id' => 35,
            'district_id' => 375,
            'name' => 'address3',
            'description' => '3. user 3.adres',
            'default' => 0,
        ]);
        //3. user 4.adres
        \App\Address::create([
            'id' => 10,
            'user_id' => 3,
            'city_id' => 34,
            'district_id' => 155,
            'name' => 'address4',
            'description' => '3. user 4.adres',
            'default' => 0,
        ]);
        //gönderiler
        //gönderi 1-ankara
        \App\Task::create([
            'id' => 1,
            'courier_id' => 1,
            'sender_id' => 1,
            'receiver_id' => 2,
            'sender_address_id' => 3,
            'receiver_address_id' => 4,
            'price' => 162,
            'description' => 'gönderi 1 ankara içi',
            'status' => 1,
        ]);
        //gönderi 2-istanbul
        \App\Task::create([
            'id' => 2,
            'courier_id' => 2,
            'sender_id' => 2,
            'receiver_id' => 3,
            'sender_address_id' => 5,
            'receiver_address_id' => 10,
            'price' => 211,
            'description' => 'gönderi 2 istanbul içi',
            'status' => 1,
        ]);
        //gönderi 3-izmir
        \App\Task::create([
            'id' => 3,
            'courier_id' => 3,
            'sender_id' => 3,
            'receiver_id' => 1,
            'sender_address_id' => 8,
            'receiver_address_id' => 2,
            'price' => 154,
            'description' => 'gönderi 3 izmir içi',
            'status' => 1,
        ]);
        //gönderi 4-istanbul-izmir
        \App\Task::create([
            'id' => 4,
            'courier_id' => 3,
            'sender_id' => 1,
            'receiver_id' => 3,
            'sender_address_id' => 1,
            'receiver_address_id' => 9,
            'price' => 524,
            'description' => 'gönderi 4 istanbul-izmir arası',
            'status' => 1,
        ]);


    }
}
