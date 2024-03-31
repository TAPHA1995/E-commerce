<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\{Factory, Generator};

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for($i=0; $i< 30; $i++ ){
            Product::create([
            'titre'=> $faker->sentence(3),
            'slug'=> $faker->slug,
            'subtitle'=> $faker->sentence(4),
            'description'=> $faker->text,
            'price'=> $faker->numberBetween(500, 100) * 100,
            'image'=> 'https://placehold.co/200x250',
            ]);
        }
    }
}
