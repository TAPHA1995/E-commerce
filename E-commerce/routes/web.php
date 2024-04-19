<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
Auth::routes();


//Affichage page d'accueil
Route::get('/', [ProductController::class, 'index'])->name('produit.index');
//Affichage détail des produits
Route::get('/produitShow/{slug}', [ProductController::class, 'show'])->name('product.show');

//update quantity
Route::put('/cart/update', [CardController::class, 'updateCart'])->name('cart.update');



//Ajouter à la card
Route::post('/panier/ajouter', [CardController::class, 'addCart'])->name('card.store');

//AFFICHER LE PANIER
Route::get('/panier',[CardController::class, 'index'])->name('card.index');
//SUPPRIMER DES PRODUIT DANS LE PANIER
Route::delete('/cart/supprimer',[CardController::class, 'removeitem'])->name('card.supprimer');
//VIDER LE PANIER
Route::delete('/cart/viderPanier',[CardController::class, 'clearCart'])->name('card.vider');
//AJOUTER AU FAVORIE
// Route::post('/wishlist/add',[WishlistController::class, 'addProductTowishlist'])->name('wishlist.store');
Route::post('/wishlist/add', [WishlistController::class, 'addProductTowishlistt'])->name('wishlist.store');

//Middleware
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->Middleware('Admin');

