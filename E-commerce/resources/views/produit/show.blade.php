@extends('layouts.master')
@section('content')
<div class="col-md-12" style="height:400px">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-330 position-relative" >
      <div class="col p-4 d-flex flex-column position-static">
        <strong class="d-inline-block mb-2 text-success">{{$product->category->titre}}</strong>
        <h3 class="mb-0">{{$product->titre}}</h3>
        <div class="mb-1 text-muted">{{$product->created_at->format('d/m/Y')}}</div>
        <p class="mb-auto">{{$product->description}}.</p>
        @if ($product->sale_price)
          <p><strong>{{$product->sale_price}} Cfa</strong></p>
          <del>{{$product->regular_price}}</del>
          <span>{{round((($product->regular_price - $product->sale_price)/$product->regular_price)*100)}}% de réduction</span>
        @else
          <p><strong>{{$product->regular_price}} Cfa</strong></p>
        @endif
        <div>
        @if ($product->stock_status == 'instock')
          Instock
        @else
          out of stock
        @endif
        </div>
        <br/>
         <form action="{{ route('card.store')}}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <input type="hidden" name="quantity" id="qty"value="1">
            <input type="hidden" name="livraison" id="lvr"value="2000">
            <button type="submit" class="btn btn-success"
            @if ($product->livraisonOrDK == 'Hors Dakar->Non disponible')
                onclick='return confirm("La livraison Hors Dakar est non disponible pour cet article. cliquez sur OK si vous étés sur Dakar sinon cliquez sur  Annuler ?")'
            @endif
             >Ajouter au panier</button>
         </form>
      </div>
      <div>
        <div class="col-auto d-none d-lg-block">
          <img src="/assets/image_produit/{{$product->image}}" alt="{{$product->titre}}">
        </div>
        @if ($product->images)
            @php
              $images = explode(',',$product->images);
            @endphp
            @foreach($images as $image)
            <div class="col-auto d-none d-lg-block">
              <img src="/assets/image_produit/{{$image}}" alt="">
            </div>
            @endforeach
        @endif
      </div>
      <div>
        @foreach ($rproducts as $rproduct)
      <div class="col-md-6">
          <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
          <div class="col p-4 d-flex flex-column position-static">
              <strong class="d-inline-block mb-2 text-success">{{$rproduct->titre}}</strong>
              <p class="mb-auto">{{$rproduct->description}}.</p>
              <p class="mb-auto">{{$rproduct->category->titre}}.</p>
              <p><strong>@if($rproduct->sale_price){{$rproduct->sale_price}}@else{{$rproduct->regular_price}}@endif Cfa</strong></p>
              <a href="{{route('product.show', $rproduct->slug)}}" class="stretched-link btn btn-success">voir</a>
          </div>
          <div class="col-auto d-none d-lg-block">
              <img src="assets/image_produit/{{$rproduct->image}}" alt="">
          </div>
          </div>
      </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
