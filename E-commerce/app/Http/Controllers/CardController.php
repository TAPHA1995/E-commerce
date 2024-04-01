<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function store(Request $request)
    {
        Cart::add($request->id, $request->titre, 1, $request->price, ['image' => 'image'])->associate('App\Product');
        return redirect('/')->with('success', 'Le produit a bien été ajouté.');
    }
}
