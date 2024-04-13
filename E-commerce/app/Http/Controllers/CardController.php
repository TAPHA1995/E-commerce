<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        $cartItems = Cart::instance('cart.index')->content();
        return view('cart.index', ['cartItems'=>$cartItems]);
    }

    public function addCart(Request $request)
    {

        $product = Product::find($request->product_id);
        $price = $product->sale_price ? $product->sale_price : $product->regular_price;
        Cart::instance('cart.index')->add($product->id, $product->titre, 1,$price)->associate('App\Models\Product');
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


}
