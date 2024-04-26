@extends('layouts.master')
@section('content')
    <div style="display:flex; align-items:center; gap:30px; margin-bottom:10px">
        <div>
            <select class="form-select" id="pagesize" name="size">
                <option value="25"{{ $size == 25 ? ' selected' : '' }}>25 Produits par page</option>
                <option value="35"{{ $size == 35 ? ' selected' : '' }}>35 Produits par page</option>
                <option value="50"{{ $size == 50 ? ' selected' : '' }}>50 Produits par page</option>
                <option value="100"{{ $size == 100 ? ' selected' : '' }}>100 Produits par page</option>
            </select>
        </div>
        <div>
            <select class="form-select" id="orderby" name="orderby">
                <option value="-1"{{ $order == -1 ? ' selected' : '' }}>Par ordre</option>
                <option value="1"{{ $order == 1 ? ' selected' : '' }}>Nouveau</option>
                <option value="2"{{ $order == 2 ? ' selected' : '' }}>Ancien</option>
                <option value="3"{{ $order == 3 ? ' selected' : '' }}>Moin cher</option>
                <option value="4"{{ $order == 4 ? ' selected' : '' }}>Plus cher</option>
            </select>
        </div>
    </div>
    <div style="display:flex; flex-direction:row; justify-content:start; gap:10px;">
        <div  style="display:flex; flex-direction:column;">
            <ul class="list-group" style="width:200px">
            <div style="text-align:center; font-size:20px">Marque</div>
                @foreach ($brands as $brand)
                    <li class="list-group-item">
                        <input class="form-check-input me-1" id="br{{$brand->id}}" name="brands"
                        {{ in_array($brand->id, explode(',', $q_brands)) ? 'checked' : '' }}
                        value="{{$brand->id}}"   type="checkbox" onchange="filterproductsByBrands()">
                        <label class="form-check-label" for="firstCheckbox">{{$brand->titre}} ({{$brand->product->count()}})</label>
                    </li>
                @endforeach
            </ul>
            </br>
            <ul class="list-group">
            <div style="text-align:center; font-size:20px">Catégories</div>
                @foreach ($categories as $category)
                <li class="list-group-item">
                    <input class="form-check-input me-1"
                    name="categories" id="ct{{$category->id}}"
                    {{ in_array($category->id, explode(',', $q_categories)) ? 'checked' : '' }}
                    type="checkbox" value="{{$category->id}}" onchange="filterproductsByCategories()">
                    <label class="form-check-label" for="firstCheckbox">
                    {{$category->titre}} ({{$category->products_count}})</label>
                </li>
                @endforeach
            </ul>
            <div>
                <div style="text-align:center; font-size:20px">Prix</div>
                <input type="text" id="priceRangeSlider" name="priceRange" />
            </div>
        </div>
        <div class="d-flex flex-column flex-wrap flex-md-row justify-content-start align-items-center gap-2 ">
        @php
            $witems = Cart::instance('layouts.wishlist')->content()->pluck('id');
        @endphp
         @foreach ($products as $product)
    <!-- Affichage de chaque produit -->
    <a href="{{ route('product.show', $product->slug) }}" class="" style="text-decoration:none; color:black">
        <div class="tpn_card">
            <img src="assets/image_produit/{{ $product->image }}" alt="">
            <h5>{{ Illuminate\Support\Str::of($product->titre)->words(3) }}</h5>
            <p><strong>{{ $product->getPrice() }} FCFA</strong></p>
            <a href="{{ route('product.show', $product->slug) }}" class="btn tpn_btn btn-success color-dark" style="margin-top:-10px">Voir</a>

        </div>
    </a>
@endforeach
{{ $products->withQueryString()->links() }}
    </div>
    <div>
    </div>
    <form id="formfilter" method="GET">
        <input type="hidden" name="page" id="page" value="{{$page}}"/>
        <input type="hidden" name="size" id="size" value="{{$size}}"/>
        <input type="hidden" name="order" id="order" value="{{$order}}"/>
        <input type="hidden" name="brands" id="brands" value="{{$q_brands}}"/>
        <input type="hidden" name="categories" id="categories" value="{{$q_categories}}"/>
        <input type="hidden" name="price_min" id="price_min" value="{{$price_min}}"/>
        <input type="hidden" name="price_max" id="price_max" value="{{$price_max}}"/>
    </form>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css">

<script>
    function filterproductsByBrands() {
        var brands = $("input[name='brands']:checked").map(function () {
            return $(this).val();
        }).get().join(",");
        $("#brands").val(brands);
        $("#formfilter").submit();
    }

    function filterproductsByCategories() {
        var categories = $("input[name='categories']:checked").map(function () {
            return $(this).val();
        }).get().join(",");
        $("#categories").val(categories);
        $("#formfilter").submit();
    }

    $(document).ready(function () {
        // Récupérer les valeurs de prix min et max depuis les paramètres de requête
        var price_min = parseInt("{{$price_min}}");
        var price_max = parseInt("{{$price_max}}");

        // Initialiser le curseur de prix
        var priceSlider = $("#priceRangeSlider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 1000000,
            from: price_min,
            to: price_max,
            step: 1000,
            onStart: function (data) {
                data.old_from = data.from;
                data.old_to = data.to;
            },
            onChange: function (data) {
                $("#price_min").val(data.from);
                $("#price_max").val(data.to);
            },
            onFinish: function (data) {
                $("#formfilter").submit();
            }
        });

        // Gestion de la sélection de la taille
        $("#pagesize").on("change", function () {
            $("#size").val($(this).val()); // Modifier le sélecteur pour récupérer la valeur de #pagesize
            $("#formfilter").submit();
        });

        // Gestion de la sélection de l'ordre
        $('#orderby').on("change", function () {
            $("#order").val($(this).val()); // Modifier le sélecteur pour récupérer la valeur de #orderby
            $("#formfilter").submit();
        });
    });





    $(document).ready(function() {
        $('.addToWishlistBtn').on('click', function() {
            var product_id = $(this).data('id');
            var product_titre = $(this).data('titre');
            var product_regular_price = $(this).data('regular_price');

            $.ajax({
                url: '{{ route('wishlist.store') }}',
                type: 'POST',
                data: {
                    product_id: product_id,
                    product_titre: product_titre,
                    product_regular_price: product_regular_price,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert('Une erreur s\'est produite. Veuillez réessayer.');
                    }
                },
                error: function() {
                    alert('Une erreur s\'est produite. Veuillez réessayer.');
                }
            });
        });
    });
</script>
