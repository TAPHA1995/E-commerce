<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
//Affichage page d'accueil
Route::get('/', [ProductController::class, 'index']);
//Affichage détail des produits
Route::get('/produitShow/{id}', [ProductController::class, 'show']);

