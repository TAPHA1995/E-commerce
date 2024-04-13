@extends('layouts.master')           
@section('content')
<div style="display:flex; align-items:center; gap:30px">
    <div>
    <select class="form-select" id="pagesize" name="size">
        <option value="12"> Produits par page</option>
        <option value="12"{{$size == 12 ? 'selected':''}}>12 Produits par page</option>
        <option value="24"{{$size == 24 ? 'selected':''}}>24 Produits par page</option>
        <option value="52"{{$size == 52 ? 'selected':''}}>52 Produits par page</option>
        <option value="100"{{$size == 100 ? 'selected':''}}>100 Produits par page</option>
    </select>
    </div>
    <div>
    <select class="form-select" id="orderby" name="orderby">
        <option value="-1"{{$order ==- 1? 'selected':''}}>Par ordre</option>
        <option value="1"{{$order == 1? 'selected':''}}>Nouveau</option>
        <option value="2"{{$order ==2? 'selected':''}}>Ancien</option>
        <option value="3"{{$order ==3? 'selected':''}}>Moin cher</option>
        <option value="4"{{$order ==4? 'selected':''}}>Plus cher</option>
    </select>
    </div>
</div>
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
        {{ $product->withQueryString()->links() }}
    </div>
    <form id="formfilter" method="GET">  
        <input type="hidden" name="page" id="page" value="{{$page}}"/>
        <input type="hidden" name="size" id="size" value="{{$size}}"/>
        <input type="hidden" name="order" id="order" value="{{$order}}"/>
    </form>
    <script>
        $("#pagesize").on("change",function()
        {
        $("#size").val($("#pagesize option:selected").val());
        $("#formfilter").submit();
        });
        $('#orderby').on("change", function(){
           $("#order").val($("#orderby option:selected").val());
           $("#formfilter").submit();  
        })
    </script>
@endsection

