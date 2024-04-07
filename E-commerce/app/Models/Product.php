<?php

namespace App\Models;

use Carbon\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class Product extends Model
{
   public function getPrice()
   {
     $price = $this->regular_price;

     return number_format($price, 2, ',', ' ');
   }

   public function getPrice_sale()
   {
     $price = $this->sale_price;

     return number_format($price, 2, ',', ' ');
   }

   public function category()
   {
      return $this->belongsTo(Category::class, 'category_id');
   }

   public function brand()
   {
      return $this->belongsTo(Brand::class, 'brand_id');
   }

   public function PRODUCT()
   {
      return $this->belongsTo(Product::class, 'product_id');
   }
}
