<?php
namespace App\Http\Controllers;
use App\Models\order;
use App\Models\order_product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Mail\OrderPlace;
use Illuminate\Support\Facades\Mail;
// Correction de la classe Mail

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Création d'une nouvelle commande
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'nbr_article' => $request->nbr_article,
            'subtotal' => $request->subtotal,
            'telephone1' => $request->telephone1,
            'telephone2' => $request->telephone2,
            'email' => $request->email,
            'Adresse_domicile' => $request->Adresse_domicile,
            'montant_total' => $request->montant_total,
        ]);

        //INSERER LES PRODUIT DE LA COMMANDE
        foreach (Cart::instance('cart.index')->content() as $item) {
            order_product::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        // dd(Cart::instance('cart.index')->content());
        // Vider la session après avoir créé la commande
        // Cart::instance('cart.index')->destroy();
        // $this->orderEmail($order);
        return redirect()->back()->with('success', 'Votre commande a été bien reçue !.');


    }

    public function orderEmail(Request $order_id)
    {
        $order_id= 4;
        $morder = Order::where('id', $order_id)->with('products')->first();

        $mailData = [
            'subject'=> 'Merci d\'avoir passé une commande chez nous',
            'order'=> $morder,
        ];
        Mail::to($morder->email)->send(new OrderPlace($mailData));
        // dd($morder);

        // $order_id ='4';
        // $morder = Order::where('id', $order_id)->with('products')->first();
        // $mailData = [
        //     'subject'=> 'Merci d\'avoir passé une commande chez nous',
        //     'order'=> $morder,
        // ];

        // Mail::to($morder->email)->send(new OrderPlace($mailData));
        // dd($morder);
    }
}
