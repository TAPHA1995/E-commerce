<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        $product_name = $this ->faker->unique()->words($nb=2, $asText = true);
        $slug = Str::slug($product_name);
        $image_name = $this->faker->numberBetween(1,24).'.png';

        return [
            'titre' =>Str::title($product_name),
            'slug' =>$slug,
            'description' => $this->faker->text(200),
            'regular_price' => $this->faker->numberBetween(100000,1000000),
            'SKU' => $this->faker->numberBetween(100,5000),
            'stock_status' => 'instock',
            'quantity' => $this->faker->numberBetween(100,200),
            'image' => $image_name,
            'images' => $image_name,
            'category_id' => $this->faker->numberBetween(1,6),
            'brand_id' => $this->faker->numberBetween(1,6),
        ];
    }
}
