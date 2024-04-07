<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // $product= Product::orderBy('created_at', 'desc')->paginate(12);
        // return view('produit.index',['product' => $product]);

        $product = Product::paginate(10);

        // Utilisez withQueryString() pour conserver tous les paramètres de la requête dans les liens de pagination
        $product->withQueryString();

        return view('produit.index', compact('product'));
    }

    public function show($slug)
    {
    $product = Product::where('slug', $slug)->first();
    $rproducts = Product::where('slug','!=', $slug)->inRandomOrder('id')->get()->take(4);
     return view('produit.show',['product'=>$product,'rproducts'=>$rproducts]);
    }
}