<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class order extends Model
{
    protected $fillable = ['user_id', 'nbr_article', 'subtotal', 'telephone1','telephone2','email','Adresse_domicile','montant_total'];
   public function user()
   {
    return $this->belongsTo('App\user');
   }

   public function products()
    {
        // return $this->belongsToMany('App\Product')->withPivot('quantity');
        return $this->hasMany(order_product::class);
    }

}
