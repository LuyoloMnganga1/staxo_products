<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
            DB::table('products')->insert([
                'image' => 'N/A',
                'name' => $faker->name,
                'price' => rand(10,100),
                'created_at'=>Carbon::now(),
            ]);
        }
    }
}
