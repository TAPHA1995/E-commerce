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
        $page = $request->query("page");
        $size = $request->query("size");

        if (!$page) 
            $page =1;
        if (!$size)
           $size =12;
        $order = $request->query("order");
        if(!$order)
           $order= -1;
        $o_column="";
        $o_order="";
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

        $brands = Brand::orderBy("titre",'ASC')->get();
        $q_brands = $request->query("brands");
        $categories = Category::withCount('products')->orderBy('titre', 'ASC')->get();
        $q_categories = $request->query("categories");


        $prange = $request->query("prange");
       
        if (!$prange) {
            $prange = "0,1000000";
        }
        $prangeArray = explode(",", $prange);

        $from = isset($prangeArray[0]) ? $prangeArray[0] : 0;
        $to = isset($prangeArray[1]) ? $prangeArray[1] : 1000000;
        
        $product = Product::where(function($query) use($q_brands) {
            $query->whereIn('brand_id', explode(',', $q_brands))->orWhereRaw("'".$q_brands."'=''");
        })
        ->where(function($query) use($q_categories) {
            $query->whereIn('category_id', explode(',', $q_categories))->orWhereRaw("'".$q_categories."'=''");
        })
        ->whereBetween('regular_price', [$from, $to])
        ->orderBy('created_at', 'DESC')
        ->orderBy($o_column, $o_order)
        ->paginate($size);
        
        $product->withQueryString();
        
        return view('produit.index', [
            'product' => $product,
            'page' => $page,
            'size' => $size,
            'order' => $order,
            'brands' => $brands,
            'q_brands' => $q_brands,
            'categories' => $categories,
            'q_categories' => $q_categories,
            'from' => $from,
            'to' => $to
        ]);




        // $prange = $request->query("prange");
      
        // if (!$prange)
        // $prange = "0,1000000";
        // $from = explode(",",$prange)[0];
        // $to = explode(",",$prange)[1];
        // $product = Product::where(function($query) use($q_brands){
        //     $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
        // })
        // ->where(function($query) use($q_categories){
        //     $query->whereIn('category_id',explode(',',$q_categories))->orWhereRaw("'".$q_categories."'=''");
        // })->whereBetween('regular_price',array($from,$to))
        // ->orderBy('created_at','DESC')->orderBy($o_column,$o_order)->paginate($size);
        // $product->withQueryString();
        // return view('produit.index',['product'=>$product,'page'=>$page,'size'=>$size,'order'=>$order,"brands"=> $brands,'q_brands'=>$q_brands,'categories'=>$categories,'q_categories'=>$q_categories,'from'=>$from,'to'=>$to]);
    }

    public function show($slug)
    {
    $product = Product::where('slug', $slug)->first();
    $rproducts = Product::where('slug','!=', $slug)->inRandomOrder('id')->get()->take(4);
     return view('produit.show',['product'=>$product,'rproducts'=>$rproducts]);
    }
}