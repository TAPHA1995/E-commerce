<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product= Product::orderBy('created_at', 'desc')->take(6)->get();
        return view('produit.index')->with('product', $product);
    }

    public function show($id)
    {
     $product = Product::findOrFail($id);

     return view('produit.show')->with('product', $product);
    }

}
