@extends('layouts.master')           
@section('content')
    <div style="display:flex; align-items:center; gap:30px; margin-bottom:10px">
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
    <div style="display:flex; flex-direction:row; justify-content:start; gap:10px;">
        <div  style="display:flex; flex-direction:column;">
            <ul class="list-group" style="width:200px">
            <div style="text-align:center; font-size:20px">Marque</div>
                @foreach ($brands as $brand)
                    <li class="list-group-item">
                        <input class="form-check-input me-1"id="br{{$brand->id}}" name="brands"
                        @if (in_array($brand->id,explode(',',$q_brands))) checked="checked"  
                        @endif value="{{$brand->id}}"   type="checkbox" onchange="filterproductsByBrands(this)">
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
                    @if (in_array($category->id,explode(',',$q_categories))) checked="checked"  
                    @endif
                    type="checkbox" value="{{$category->id}}" onchange="filterproductsByCategories(this)">
                    <label class="form-check-label" for="firstCheckbox">
                    {{$category->titre}} ({{$category->products_count}})</label>
                </li>
                @endforeach
            </ul>
            <div class="accordion-items category-price">
              <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">Price
              </button>
              <h2>
              <div id="collapseFour" class="accordion-collapse collapse show" aria-labelledby="headingFour" data-be-parent="#accordionExample">
              <div class="accordion-body">
               <div class="range-slider category-list">
                    <input type="range" class="js-range-slider" id="js-range-price" value="{{ $from }},{{ $to }}" min="0" max="1000000" step="100"/>
               </div>
              </div>
              </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-wrap flex-md-row justify-content-start align-items-center gap-2 ">
            @foreach ($product as $products)
            <a href="{{route('product.show', $products->slug)}}" class="" style="text-decoration:none; color:black">
                <div class="tpn_card">
                    <img src="assets/image_produit/{{$products->image}}" alt="">
                    <h5>{{ Illuminate\Support\Str::of($products->titre)->words(3)}}</h5>
                    <p><strong>{{$products->regular_price}} FCFA</strong></p>
                     <a href="{{route('product.show', $products->slug)}}" class="btn tpn_btn btn-success color-dark" style="margin-top:-10px">Voir</a>
                </div>
            </a>
            @endforeach
        </div>   
    </div>
    <div>
    {{ $product->withQueryString()->links() }}
    </div>
    <form id="formfilter" method="GET">  
        <input type="hidden" name="page" id="page" value="{{$page}}"/>
        <input type="hidden" name="size" id="size" value="{{$size}}"/>
        <input type="hidden" name="order" id="order" value="{{$order}}"/>
        <input type="hidden" name="brands" id="brands" value="{{$q_brands}}"/>
         <input type="hidden" name="categories" id="categories" value="{{$q_categories}}"/>
        <form id="formfilter" method="GET">  
            <input type="hidden" name="prange" id="prange" value="{{ $from }},{{ $to }}"/>
        </form> 
    </form>
    <script>
    $(function () {
          $("#pagesize").on("change",function()
        {
        $("#size").val($("#pagesize option:selected").val());
        $("#formfilter").submit();
        });
        $('#orderby').on("change", function(){
           $("#order").val($("#orderby option:selected").val());
           $("#formfilter").submit();  
        })
      
        $(document).ready(function() {
                var $range = $(".js-range-slider");
                var instance = $range.data("ionRangeSlider");
                $range.on("change", function () {
                    var value = $(this).val();
                    $("#prange").val(value);
                    setTimeout(function() {
                        $("#formfilter").submit();
                    }, 1000);
                });
            });
        });
        function filterproductsByBrands(brand) {
            var brands = "";
            $("input[name='brands']:checked").each(function () {
                if (brands=="") {
                    brands += this.value;
                } else {
                    brands += "," + this.value;
                }
            });
            $("#brands").val(brands);
            $("#formfilter").submit(); 
        }


        function filterproductsByCategories(brand) {
            var categories = "";
            $("input[name='categories']:checked").each(function () {
                if (categories=="") {
                    categories += this.value;
                } else {
                    categories += "," + this.value;
                }
            });
            $("#categories").val(categories);
            $("#formfilter").submit(); 
        }

        $(document).ready(function () {
            var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

                trigger.click(function () {
                hamburger_cross();      
                });

            function hamburger_cross() {

            if (isClosed == true) {          
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {   
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }
            
            $('[data-toggle="offcanvas"]').click(function () {
                    $('#wrapper').toggleClass('toggled');
            });  
            });
    </script>

    <style>
    
      .demo_title h1,h6{
        color: var(--bg-darker);
        }

        #copyrights{
        position: absolute;
        bottom: 2%;
        right: 2%;
        }

        #copyrights a{
        text-decoration: none;
        color: var(--bg-darker);
        }

        /* tpn card style */
        .tpn_card{
        background: #ffffff;
        padding: 13px;
        border-radius:27px;
        width:250px;
        }

        .tpn_card img{
        border-radius:23px;
        box-shadow: 1px 7px 13px var(--shadow);
        }

        .tpn_card h5{
        color: var(--bg-dark);
        }

        .tpn_card p{
        color: var(--font-body);
        font-weight:400;
        margin-bottom:24px;
        }

        .tpn_card .tpn_btn{
        padding:13px 27px !important;
        line-height: normal;
        background: green;
        border-radius:17px;
        text-decoration:none;
        color: black;
        box-shadow: 1px 7px 13px var(--shadow);
        transition: all .7s ease;
        }

        .tpn_card .tpn_btn:hover{
        background: var(--bg-darker);
        box-shadow: none;
        }
    </style>
@endsection

