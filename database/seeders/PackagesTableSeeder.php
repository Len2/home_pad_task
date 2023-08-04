<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <=15; $i++) {
            $registrationLimit = rand(3, 8);
            Package::create(['name' =>"package $i",'limit'=>$registrationLimit,]);
        }
    }
}
