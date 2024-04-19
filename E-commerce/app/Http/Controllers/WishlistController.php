<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;


// class WishlistController extends Controller
// {
//     public function addProductTowishlist(Request $request)
//     {
//         Cart::instance("layouts.wishlist")->add($request->id,$request->titre,1,$request->price)->associate("App\Models\Product");
//         return response()->json(['status'=>'le produit a été bien ajouté au favorie']);
//     }
// }

class ProductController extends Controller
{
    // Autres méthodes...

    public function addProductTowishlist(Request $request)
    {
        $productId = $request->input('product_id');
        $productTitre = $request->input('product_titre');
        $productPrice = $request->input('product_regular_price');

        Cart::instance('layouts.wishlist')->add($productId, $productTitre, 1, $productPrice);

        return response()->json(['status' => 'success', 'message' => 'Le produit a été ajouté à la liste de souhaits.']);
    }
}
