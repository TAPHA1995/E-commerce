<?php

namespace App\Http\Controllers;

// use App\Models\order;
// use App\Models\Product;
// use Gloudemans\Shoppingcart\Facades\Cart;
// use Illuminate\Http\Request;
// use App\Models\Wishlist;
// use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist; // Include the Wishlist model
use App\Models\order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart.index')->content();
        return view('cart.index', ['cartItems'=>$cartItems]);
    }


    // public function addCart(Request $request)
    // {


    //     $duplicata = Cart::search(function($cartItem, $rowId) use($request)
    //     {
    //         return $cartItem->id == $request->product_id;
    //     });
    //     if ($duplicata->isNotEmpty()) {
    //         return redirect('/')->with('success', 'Le produit a bien été déjà ajouté.');
    //     }
    //     $product = Product::find($request->product_id);
    //     $price = $product->sale_price ? $product->sale_price : $product->regular_price;
    //     Cart::instance('cart.index')->add($product->id, $product->titre, 1,$price)->associate('App\Models\Product');
    //     return redirect('/')->with('success', 'Le produit a bien été ajouté.');


    // }
    public function addCart(Request $request)
{
    $duplicata = Cart::instance('cart.index')->search(function($cartItem, $rowId) use($request)
    {
        return $cartItem->id == $request->product_id;
    });


    if ($duplicata->isNotEmpty()) {
        return redirect('/')->with('success', 'Le produit a déjà été ajouté.');
    }

    $product = Product::find($request->product_id);
    $price = $product->sale_price ? $product->sale_price : $product->regular_price;

    Cart::instance('cart.index')->add($product->id, $product->titre, 1, $price)->associate('App\Models\Product');

    return redirect('/')->with('success', 'Le produit a bien été ajouté.');
}

    public function updateCart(Request $request)
    {
        Cart::instance('cart.index')->update($request->rowId, $request->quantity);
        return redirect()->back();

    }

    public function removeitem(Request $request)
    {
        $rowId = $request->rowId;
        Cart::instance('cart.index')->remove($rowId);
        return redirect()->back();
    }

    public function clearCart()
    {
        Cart::instance('cart.index')->destroy();
        return redirect()->back();
    }

    public function add_to_wishlist(Request $request)
  {
    $check = Wishlist::checkAlready($request->product_id, Auth::user()->id); // Appeler directement la fonction statique

    if (empty($check)) {
      $save = new Wishlist;
      $save->product_id = $request->product_id;
      $save->user_id = Auth::user()->id;
      $save->save();
      $json['is_wishlist'] = 1;
    } else {
      Wishlist::DeleteRecord($request->product_id, Auth::user()->id);
      $json['is_wishlist'] = 0;
    }
    $json['status'] = true;
    echo json_encode($json);
  }

}
