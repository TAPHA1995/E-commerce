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

        $duplicat = Cart::instance('cart.index')->content();

        // $duplicat->search(function ($cartItem, $rowId) {
        //     return $cartItem->id === 1;
        // });

        // $duplicat = Cart::search(function ($cartItem, $rowId) use($request) {
        //     return $cartItem->id == $request->product_id;
        // });


        $product = Product::find($request->product_id);
        $cartItems = Cart::instance('cart.index')->content();
        $duplicat =Cart::search(function ($cartItem, $rowId)
            use($request) {
                return $cartItem->id == $request->product_id;
            });
        if ( $request->product_id ===1) {
            return redirect('/')->with('success', 'Le produit a déjà été ajouté.');
        }
        Cart::instance('cart.index')->add($product->id, $product->titre, 1, $product->price)->associate('App\Models\Product');
        return redirect('/')->with('success', 'Le produit a bien été ajouté.');
    }






    // public function store(Request $request)
    // {

    //     $duplicat =Cart::search(function ($cartItem, $rowId)

    //     use($request) {
    //         return $cartItem->id == $request->product_id;
    //     });
    //     if ($duplicat->isNotEmpty()) {
    //         return redirect('/')->with('success', 'Le produit a déjà été ajouté.');
    //     }
    //     $product =Product::find($request->product_id);

    //     Cart::add($product->id, $product->titre, 1, $product->price)->associate('App\Product');
    //     return redirect('/')->with('success', 'Le produit a bien été ajouté.');
    // }

    // public function index()
    // {
    //     return view('cart.index');
    // }










}
