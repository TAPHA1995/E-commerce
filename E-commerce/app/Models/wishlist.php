<?php

namespace App\Models;

use Carbon\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;


class Wishlist extends Model
{
  protected $table = 'wishlists';

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

  static public function checkAlready($product_id, $user_id)
  {
    return self::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->count();
  }

  static public function DeleteRecord($product_id, $user_id)
  {
    return self::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->delete();
  }
}


// namespace App\Models;

// use Carbon\Factory;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Pagination\LengthAwarePaginator;
// use Illuminate\Support\Str;

// class Wishlist extends Model
// {
//     protected $table = 'wishlists';
//    public function getPrice()
//    {
//      $price = $this->regular_price;

//      return number_format($price, 2, ',', ' ');
//    }

//    public function getPrice_sale()
//    {
//      $price = $this->sale_price;

//      return number_format($price, 2, ',', ' ');
//    }

//    public function category()
//    {
//       return $this->belongsTo(Category::class, 'category_id');
//    }

//    public function brand()
//    {
//       return $this->belongsTo(Brand::class, 'brand_id');
//    }

//    public function PRODUCT()
//    {
//       return $this->belongsTo(Product::class, 'product_id');
//    }
//    static public function checkAlready($product_id, $user_id){
//     return self::where('product_id', '=', $product_id)->where('user_id', '=', $user_id)->count();
//   }

//    static public function DeleteRecord($product_id, $user_id){
//     return self::where('product_id','=',$product_id)->where('user_id','=',$user_id)->delete();
//    }
// }
