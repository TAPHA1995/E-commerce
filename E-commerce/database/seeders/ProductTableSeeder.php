<?php

namespace Database\Seeders;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\{Factory, Generator};
use Illuminate\Support\Str;


class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Factory::create();
        // for($i=0; $i< 30; $i++ ){
        //     Product::create([
        //     'titre'=> $faker->sentence(3),
        //     'slug'=> $faker->slug,
        //     'subtitle'=> $faker->sentence(4),
        //     'description'=> $faker->text,
        //     'price'=> $faker->numberBetween(500, 100) * 100,
        //     'image'=> 'https://placehold.co/200x250',
        //     ]);
        // }

        $faker = Factory::create();
        for($i=0; $i< 30; $i++ ){
            Product::create([
            'titre'=> $faker->sentence(3),
            'slug'=> $faker->slug,
            'description'=> $faker->text,
            'regular_price'=> $faker->numberBetween(100000,1000000),
            'SKU' => $faker->numberBetween(100,5000),
            'livraisonDK'=> 'DAKAR->2000 Cfa',
            'livraisonOrDK'=>'Hors Dakar->3000 Cfa',
            'livraisonGratuit' => 'Gratuit',
            'subtitle'=> $faker->sentence(4),
            'stock_status' => 'instock',
            'quantity' => $faker->numberBetween(100,200),
            'image'=> 'images (1).jpg',
            'images'=> 'images (1).jpg',
            'category_id' => $faker->numberBetween(1,6),
            'brand_id' => $faker->numberBetween(1,6),
            ]);
        }




        // $product_name = $this ->faker->unique()->words($nb=2, $asText = true);
        // $slug = Str::slug($product_name);
        // $image_name = $this->faker->numberBetween(1,24).'.png';

        // return [
        //     'titre' =>Str::title($product_name),
        //     'slug' =>$slug,
        //     'description' => $this->faker->text(200),
        //     'regular_price' => $this->faker->numberBetween(100000,1000000),
        //     'SKU' => $this->faker->numberBetween(100,5000),
        //     'stock_status' => 'instock',
        //     'quantity' => $this->faker->numberBetween(100,200),
        //     'image' => $image_name,
        //     'images' => $image_name,
        //     'category_id' => $this->faker->numberBetween(1,6),
        //     'brandy_id' => $this->faker->numberBetween(1,6),
        // ];
    }
}
