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

        // $duplicat = Cart::instance('cart.index')->content();

        // $duplicat->search(function ($cartItem, $rowId) {
        //     return $cartItem->id === 1;
        // });

        // $duplicat = Cart::search(function ($cartItem, $rowId) use($request) {
        //     return $cartItem->id == $request->product_id;
        // })

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

// Récupérer le sous-total actuel du panier
// $currentSubtotal = (float) str_replace(',', '', Cart::instance('cart.index')->subtotal());

 // Montant à ajouter au sous-total
//  $chiffreAAjouter = 2000; // Remplacez 200 par le montant que vous souhaitez ajouter

//  // Ajouter un article fictif au panier avec le montant spécifié
//  Cart::instance('cart.index')->add('chiffre_additionnel', 'Montant Additionnel', 1, $chiffreAAjouter);

//  return redirect()->back();





        // Montant de la livraison pour Dakar
        // $livraisonDK = 2000;
        // Cart::instance('cart.index')->update($request->rowId, $request->quantity);

        // Ajouter le montant de livraison comme article distinct dans le panier
        // $product = Product::find($request);
        // $subtotal =2000;
        // $newSubtotal =  $subtotal + $livraisonDK;
        // dd($newSubtotal);
        // Cart::instance('cart.index')->add($product->id, $product->titre, 1,$livraisonDK)->associate('App\Models\Product');

        // Mettre à jour le sous-total dans le panier avec le nouveau sous-total calculé
        // Cart::instance('cart.index')->update($newSubtotal);

        // return redirect()->back();


        // Récupérer la quantité actuelle dans le panier
        // $currentQuantity = Cart::instance('cart.index')->subtotal();
        // $cartItems = Cart::instance('cart.index')->content();


        // $livraisonDK=2000;

        //Ajouter un chiffre à la quantité actuelle
        // $newQuantity = $currentQuantity + $livraisonDK;

        // Mettre à jour la quantité dans le panier
        // Cart::instance('cart.index')->update($newQuantity);
        // return redirect()->back();

        // Cart::instance('cart.index')->update($request->rowId, $request->livraison);
        // return redirect()->back();


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
