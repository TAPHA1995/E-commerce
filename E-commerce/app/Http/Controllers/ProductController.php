<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $page = $request->query("page");
        // $size = $request->query("size");

        // if (!$page)
        //     $page =1;
        // if (!$size)
        //    $size =12;
        // $order = $request->query("order");
        // if(!$order)
        //    $order= -1;
        // $o_column="";
        // $o_order="";
        // switch ($order) {
        //     case 1:
        //         $o_column = "created_at";
        //         $o_order = "DESC";
        //         break;
        //     case 2:
        //         $o_column = "created_at";
        //         $o_order = "ASC";
        //         break;
        //     case 3:
        //         $o_column = "regular_price";
        //         $o_order = "ASC";
        //         break;
        //     case 4:
        //         $o_column = "regular_price";
        //         $o_order = "DESC";
        //         break;
        //     default:
        //         $o_column = "id";
        //         $o_order = "DESC";
        //         break;

        //     }

        // $brands = Brand::orderBy("titre",'ASC')->get();
        // $q_brands = $request->query("brands");
        // $categories = Category::withCount('products')->orderBy('titre', 'ASC')->get();
        // $q_categories = $request->query("categories");


        // $prange = $request->query("prange");

        // if (!$prange) {
        //     $prange = "0,1000000";
        // }
        // $prangeArray = explode(",", $prange);

        // $from = isset($prangeArray[0]) ? $prangeArray[0] : 0;
        // $to = isset($prangeArray[1]) ? $prangeArray[1] : 1000000;

        // $product = Product::where(function($query) use($q_brands) {
        //     $query->whereIn('brand_id', explode(',', $q_brands))->orWhereRaw("'".$q_brands."'=''");
        // })
        // ->where(function($query) use($q_categories) {
        //     $query->whereIn('category_id', explode(',', $q_categories))->orWhereRaw("'".$q_categories."'=''");
        // })
        // // ->whereBetween('regular_price', [$from, $to])
        // ->orderBy('created_at', 'DESC')
        // ->orderBy($o_column, $o_order)
        // ->paginate($size);

        // $product->withQueryString();

        // return view('produit.index', [
        //     'product' => $product,
        //     'page' => $page,
        //     'size' => $size,
        //     'order' => $order,
        //     'brands' => $brands,
        //     'q_brands' => $q_brands,
        //     'categories' => $categories,
        //     'q_categories' => $q_categories,
        //     'from' => $from,
        //     'to' => $to
        // ]);

    //     $page = $request->query("page") ?? 1;
    //     $size = $request->query("size") ?? 25;
    //     $order = $request->query("order") ?? -1;

    //     // Déterminer la colonne et l'ordre de tri en fonction de la valeur de $order
    //     switch ($order) {
    //         case 1:
    //             $o_column = "created_at";
    //             $o_order = "DESC";
    //             break;
    //         case 2:
    //             $o_column = "created_at";
    //             $o_order = "ASC";
    //             break;
    //         case 3:
    //             $o_column = "regular_price";
    //             $o_order = "ASC";
    //             break;
    //         case 4:
    //             $o_column = "regular_price";
    //             $o_order = "DESC";
    //             break;
    //         default:
    //             $o_column = "id";
    //             $o_order = "DESC";
    //             break;
    //     }

    //     $brands = Brand::orderBy("titre", 'ASC')->get();
    //     $q_brands = $request->query("brands");
    //     $categories = Category::withCount('products')->orderBy('titre', 'ASC')->get();
    //     $q_categories = $request->query("categories");

    //     // Récupérer les valeurs du prix minimum et maximum à partir de la requête
    //     $price_min = $request->query("price_min") ?? 0;
    //     $price_max = $request->query("price_max") ?? 999999;

    //     // Filtrer les produits en fonction des paramètres de requête
    //     $product = Product::query()
    //         ->when($q_brands, function ($query, $q_brands) {
    //             return $query->whereIn('brand_id', explode(',', $q_brands))
    //                 ->orWhereRaw("'" . $q_brands . "'=''");
    //         })
    //         ->when($q_categories, function ($query, $q_categories) {
    //             return $query->whereIn('category_id', explode(',', $q_categories))
    //                 ->orWhereRaw("'" . $q_categories . "'=''");
    //         })
    //         ->whereBetween('regular_price', [$price_min, $price_max])
    //         ->orderBy('created_at', 'DESC')
    //         ->orderBy($o_column, $o_order)
    //         ->paginate($size);

    //     $product->appends(request()->query());
    //     $product->withQueryString();

    //     return view('produit.index', [
    //         'product' => $product,
    //         'page' => $page,
    //         'size' => $size,
    //         'order' => $order,
    //         'brands' => $brands,
    //         'q_brands' => $q_brands,
    //         'categories' => $categories,
    //         'q_categories' => $q_categories,
    //         'price_min' => $price_min,
    //         'price_max' => $price_max,
    //     ]);
    // }

    // public function show($slug)
    // {
    // $product = Product::where('slug', $slug)->first();
    // $rproducts = Product::where('slug','!=', $slug)->inRandomOrder('id')->get()->take(4);
    //  return view('produit.show',['product'=>$product,'rproducts'=>$rproducts]);
    // }

        $page = $request->query("page", 1);
        $size = $request->query("size", 25);
        $order = $request->query("order", -1);

        // Déterminer la colonne et l'ordre de tri en fonction de la valeur de $order
        switch ($order) {
            case 1:
                $o_column = "created_at";
                $o_order = "DESC";
                break;
            case 2:
                $o_column = "created_at";
                $o_order = "ASC";
                break;
            case 3:
                $o_column = "regular_price";
                $o_order = "ASC";
                break;
            case 4:
                $o_column = "regular_price";
                $o_order = "DESC";
                break;
            default:
                $o_column = "id";
                $o_order = "DESC";
                break;
        }

        $brands = Brand::orderBy("titre", 'ASC')->get();
        $q_brands = $request->query("brands");
        $categories = Category::withCount('products')->orderBy('titre', 'ASC')->get();
        $q_categories = $request->query("categories");

        // Récupérer les valeurs du prix minimum et maximum à partir de la requête
        $price_min = $request->query("price_min", 0);
        $price_max = $request->query("price_max", 999999);

        // Filtrer les produits en fonction des paramètres de requête
        $products = Product::query()
            ->when($q_brands, function ($query, $q_brands) {
                return $query->whereIn('brand_id', explode(',', $q_brands))
                    ->orWhereRaw("'" . $q_brands . "'=''");
            })
            ->when($q_categories, function ($query, $q_categories) {
                return $query->whereIn('category_id', explode(',', $q_categories))
                    ->orWhereRaw("'" . $q_categories . "'=''");
            })
            ->whereBetween('regular_price', [$price_min, $price_max])
            ->orderBy('created_at', 'DESC')
            ->orderBy($o_column, $o_order)
            ->paginate($size);

        $products->appends(request()->query());

        return view('produit.index', [
            'products' => $products,
            'page' => $page,
            'size' => $size,
            'order' => $order,
            'brands' => $brands,
            'q_brands' => $q_brands,
            'categories' => $categories,
            'q_categories' => $q_categories,
            'price_min' => $price_min,
            'price_max' => $price_max,
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $rproducts = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();

        return view('produit.show', ['product' => $product, 'rproducts' => $rproducts]);
    }


}
