@extends('layouts.master')
@section('content')
    @foreach ($product as $products)
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-success">{{$products->titre}}</strong>
            <h5 class="mb-0">{{$products->titre}}</h5>
            <div class="mb-1 text-muted">{{$products->created_at->format('d/m/Y')}}</div>
            <p class="mb-auto">{{$products->subtitle}}.</p>
            <p class="mb-auto">{{$products->category->titre}}.</p>
            <p><strong>{{$products->regular_price}} Cfa</strong></p>
            <a href="{{route('product.show', $products->slug)}}" class="stretched-link btn btn-success">voir</a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img src="assets/image_produit/{{$products->image}}" alt="">
        </div>
        </div>
    </div>
    @endforeach
    <div>
        {{ $product->links() }}
    </div>
@endsection
