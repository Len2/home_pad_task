<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['uuid'=>uuid_create(),'name'=>'Lendrit','email'=>'lendrit@gmail.com','password'=>bcrypt('123456')]);
        User::create(['uuid'=>uuid_create(),'name'=>'Customer1','email'=>'customer1@gmail.com','password'=>bcrypt('123456'),'role_name'=>'customer']);
        User::create(['uuid'=>uuid_create(),'name'=>'Customer2','email'=>'customer2@gmail.com','password'=>bcrypt('123456'),'role_name'=>'customer']);
        User::create(['uuid'=>uuid_create(),'name'=>'Customer3','email'=>'customer3@gmail.com','password'=>bcrypt('123456'),'role_name'=>'customer']);
    }
}
