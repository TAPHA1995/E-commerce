<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   public function getPrice()
   {
     $price = $this->price;

     return number_format($price, 2, ',', ' ');
   }
   protected $filiable=[

    'titre', 'slug', 'subtitle', 'description', 'price','image'

];
}
