<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {


        // Création d'une nouvelle commande
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'nbr_article'=> $request->nbr_article,
            'subtotal'=> $request->subtotal,
            'telephone1'=> $request->telephone1,
            'telephone2'=> $request->telephone2,
            'email'=> $request->email,
            'Adresse_domicile'=> $request->Adresse_domicile,
            'montant_total'=> $request->montant_total,
        ]);

        //INSERER LES PRODUIT DE LA COMMANDE
        foreach (Cart::content() as $item) {
            order_product::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }
        // Cart::instance('cart.index')->destroy();
        session()->forget('');
        return redirect()->back()->with('success', 'Votre commande a été bien reçu !.');

    }


}
