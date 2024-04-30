
@extends('layouts.master')
@section('content')

<style>
    @media (min-width: 1025px) {
.h-custom {
height: 100vh !important;
}
}

.card-registration .select-input.form-control[readonly]:not([disabled]) {
font-size: 1rem;
line-height: 2.15;
padding-left: .75em;
padding-right: .75em;

}

.card-registration .select-arrow {
top: 13px;
}

.bg-grey {
background-color: #eae8e8;
}

@media (min-width: 992px) {
.card-registration-2 .bg-grey {
border-top-right-radius: 16px;
border-bottom-right-radius: 16px;
}
}

@media (max-width: 991px) {
.card-registration-2 .bg-grey {
border-bottom-left-radius: 16px;
border-bottom-right-radius: 16px;
}
}
</style>
<section class="h-100 " style="background-color: #d2c9ff; ">
    <div class="container py-5 h-100  ">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2 " style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                      <h6 class="mb-0 text-muted">{{ Cart::instance('cart.index')->content()->count() }} article @if (Cart::instance('cart.index')->content()->count() > 1) <span style="margin-left:-3px">s</span> @endif</h6>
                    </div>
                    @if ($cartItems->count() > 0)
                    @foreach ($cartItems as $product)
                    <hr class="my-4">
                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                      <div class="col-md-2 col-lg-2 col-xl-2">
                        <img
                        src="assets/image_produit/{{$product->model->image}}"
                          class="img-fluid rounded-3" alt="Cotton T-shirt">
                          <input type="text" id="" class="form-control form-control-lg mb-2 text-dark" style='height:3vh' value="@foreach ($cartItems as $product)
                          {{$product->model->image}},
                          {{$product->model->titre}},
                          {{$product->model->subtitle}},
                          {{$product->model->id}}
                          @endforeach
                          "/>

                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-3">
                        <h6 class="text-muted">{{$product->model->titre}}</h6>
                        <h6 class="text-black mb-0">{{$product->model->subtitle}}</h6>
                      </div>
                      <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                        <input name="quantity" value="{{$product->qty}}" type="number"
                          class="form-control form-control-sm" data-rowid="{{$product->rowId}}" onchange="updateQuantity(this)" />
                      </div>
                      <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                     <p>{{$product->subtotal()}} Cfa</p>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#" class="text-muted" onclick="removeItemFromCart('{{$product->rowId}}')"><i class="fas fa-times"></i></a>
                      </div>
                    </div>
                    @endforeach
                     <hr class="my-4">
                     <div style="display:flex; justify-content:between; gap:10px">
                        <a href="/" class="btn btn-primary">Continuez le Shopping</a>
                        <div class="btn btn-danger" onclick="clearCart()">Vider le panier</div>
                     </div>
                     @else
                    <div clasS="row">
                        <div class="col-md-12 text-center">
                        <h3>Votre panier est vide</h3>
                        <a href="/" class="btn btn-primary" >Shopping maintenant</a>
                        </div>
                    </div>
                    @endif
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                <form class="" action="{{route('order.store')}}" method="POST">
                @csrf
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-4">
                    <h6 class="text-uppercase"><span>{{ Cart::instance('cart.index')->content()->count() }}</span>  article @if (Cart::instance('cart.index')->content()->count() > 1) <span style="margin-left:-3px">s</span> @endif</h6>
                    <input type="text" id="" class="form-control form-control-lg mb-2" name="nbr_article" style='height:3vh' value="{{ Cart::instance('cart.index')->content()->count() }} article"/>
                      <h5>{{Cart::instance('cart.index')->subtotal()}} Cfa</h5>
                      <input type="text" id="" name="subtotal" class="form-control form-control-lg mb-2" style='height:3vh' value="{{Cart::instance('cart.index')->subtotal()}} Cfa"/>
                    </div>
                    <h5 class="text-uppercase mb-3">Livraison</h5>
                    @if ($cartItems->count() > 0)
                        <div style="display: flex; gap:10px: flex-wrap:wrap ">
                            <div class="mb-4 pb-2 livraisonDK livraisonDiv" id="monDiv">
                                <div class="btn tbnlvrDK">Dakar +2000 Cfa</div>
                            </div>
                        @php
                            $nbProduitsNonDisponibles = 0;
                        @endphp
                        @foreach($cartItems as $cartItem)
                        @if($cartItem->model->livraisonOrDK == 'Non disponible')
                            @php
                                $nbProduitsNonDisponibles++;
                            @endphp
                        @endif
                        @endforeach

                        @php
                            $nbProduitslvrGratuit = 0;
                            @endphp
                            @foreach($cartItems as $cartItem)
                            @if($cartItem->model->livraisonDK == 0)
                            @php
                                $nbProduitslvrGratuit++;
                            @endphp
                            @endif
                            @endforeach
                        @if ($nbProduitslvrGratuit == $cartItems->count() && $nbProduitsNonDisponibles == $cartItems->count())
                        <div class="mb-4 pb-2 livraisonG livraisonDiv">
                            <div class="btn tbnlvrG alert alert-success">Livraison gratuite</div>
                        </div>
                        @endif
                        @if ($nbProduitslvrGratuit == $cartItems->count() && $nbProduitsNonDisponibles > 0)
                        <button class="mb-4 pb-2 livraisonHDK" disabled>
                            <div class="alert alert-danger tbnlvrHDK">Hors Dakar Non disponible</div>
                        </button>
                        @endif

                        @if ($nbProduitslvrGratuit == $cartItems->count() && $nbProduitsNonDisponibles == 0)
                        <div class="mb-4 pb-2 livraisonHDK livraisonDiv">
                            <div class="btn tbnlvrHDK">Hors Dakar +2000 Cfa</div>
                        </div>
                        @endif
                        @if ($nbProduitsNonDisponibles == 0)
                        <div class="mb-4 pb-2 livraisonHDK livraisonDiv">
                            <div class="btn tbnlvrHDK ">Hors Dakar +2000 Cfa</div>
                        </div>
                        @endif
                        </div>
                    @endif
                    <h5 class="text-uppercase mb-3">Coordonnées</h5>
                    <div class="mb-5">
                      <div class="form-outline">
                        <input type="text" id="" name="telephone1" class="form-control form-control-lg mb-2" style='height:3vh' placeholder='Numéro Téléphone 1' required/>
                        <input type="text" id="" name="telephone2" class="form-control form-control-lg mb-2" style='height:3vh'placeholder='Numéro Téléphone 2' />
                        <input type="email" id="" name="email" class="form-control form-control-lg mb-2" style='height:3vh' placeholder='Email'/>
                        <input type="text" id="" name="Adresse_domicile" class="form-control form-control-lg mb-2" style='height:3vh' placeholder='Adresse de la livraison ' required/>
                      </div>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-5">
                    @if ($cartItems->count() > 0)
                      <h5 class="text-uppercase">Total price</h5>
                      @php
                      $produitNonDisponibleTrouve = false;
                      @endphp
                      @foreach($cartItems as $cartItem)
                      @if($cartItem->model->livraisonDK == 2500)
                      @php
                      $produitNonDisponibleTrouve = true;
                      @endphp
                      @endif
                      @endforeach

                      @if(!$produitNonDisponibleTrouve)
                      @endif
                        <h5 class="sommeTotalDK" id="sommeTotalDK">
                            @php
                             $currentSubtotal = (float) str_replace(',', '', Cart::instance('cart.index')->subtotal());
                             $SommelivraisaonDK = $currentSubtotal + $cartItem->model->livraisonDK;
                             @endphp
                            @php
                            $currentSubtotalGD = (float) str_replace(',', '', Cart::instance('cart.index')->subtotal());
                            @endphp
                            @if ($currentSubtotalGD == $SommelivraisaonDK)
                                @else
                               @php

                               @endphp
                            @endif
                            @php
                                echo $SommelivraisaonDK;
                            @endphp
                             <input type="text" id="" class="form-control form-control-lg mb-2" name="" value="{{$SommelivraisaonDK}}:Livraison Dakar"  />
                            Cfa1
                        </h5>
                        <h5 class="sommeTotalHDK " id="sommeTotalHDK monDivOrDK">

                            @if ( $product->model->livraisonOrDK == 'Non disponible')
                            <div class="alert alert-danger">livraison hors Dakar non disponible</div>
                            @else
                            @php
                            $currentSubtotal = (float) str_replace(',', '', Cart::instance('cart.index')->subtotal());
                            echo $currentSubtotal + $product->model->livraisonOrDK;
                            @endphp
                            <input type="text" id="" class="form-control form-control-lg mb-2" name="" value="{{$currentSubtotal + $product->model->livraisonOrDK}}:Livraison hors Dakar"/>
                            Cfa2
                            @endif
                        </h5>
                        <h5 class="sommeTotalG" id="sommeTotalG">
                            @php
                            $currentSubtotal = (float) str_replace(',', '', Cart::instance('cart.index')->subtotal());
                            echo $currentSubtotal;
                            @endphp
                            <input type="text" id="monInput" class="form-control form-control-lg mb-2" name="montant_total" value="{{$currentSubtotal}}"/>
                            Cfa3
                        </h5>
                      @endif
                      {{-- <div id="monDiv">Cliquez ici pour changer la valeur</div>
                      <input type="text" id="monInput" value="Valeur initiale"> --}}

                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg"
                      data-mdb-ripple-color="dark">Payer à la livraison</button>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    .sommeTotalDK{
        display: none;
    }
    .sommeTotalDK.active{
        display: flex;


    }
    .sommeTotalHDK{
        display: none;
    }
    .sommeTotalHDK.active{
        display: flex;

    }
    .sommeTotalG{
        display: none;
    }
    .sommeTotalG.active{
        display: flex;

    }
    .tbnlvrDK{
        border: 1px solid #ffff;
    }
    .tbnlvrHDK{
        border: 1px solid #ffff;
    }
    .tbnlvrDK:hover{
        background-color: blue;
    }.tbnlvrG{
        border: 1px solid #ffff;
    }
    .tbnlvrG:hover{
        background-color: blue;
    }
    .tbnlvrHDK:hover{
        background-color: blue;
    }
    .tbnlvrDK.active{
        background-color: green;
        color: white;
    }
    .tbnlvrG.active{
        background-color: green;
        color: white;
    }
    .tbnlvrHDK.active{
        background-color: green;
        color: white;
    }

  </style>
   <form id="updateCartQty" action="{{route('cart.update')}}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" id="rowId" name="rowId" />
    <input type="hidden" id="quantity" name="quantity"/>
  </form>

  <form id="deleteformCart" action="{{route('card.supprimer')}}" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" id="rowId_D" name="rowId" />
  </form>
  <form id="clearCart" action="{{route('card.vider')}}" method="POST">
      @csrf
      @method('delete')
  </form>



  <script>

// // Sélectionnez le div par son ID
// var monDivOrDK = document.getElementById("monDivOrDK");
// // Sélectionnez l'input par son ID
// var monInput = document.getElementById("monInput");
// // Sélectionnez le div par son ID
// var monDiv = document.getElementById("monDiv");
// // Sélectionnez l'input par son ID
// var monInput = document.getElementById("monInput");

// // Ajoutez un gestionnaire d'événements pour le clic sur le div
// monDiv.addEventListener("click", function() {
//     // Obtenez la valeur actuelle de l'input et convertissez-la en nombre
//     var inputValue = parseFloat(monInput.value);
//     // Effectuez l'opération 2000 + la valeur de l'input
//     var resultat = 500 + inputValue + ': Livraison Dakar';
//     // Mettez à jour la valeur de l'input avec le résultat de l'opération
//     monInput.value = resultat;
// });



// // Ajoutez un gestionnaire d'événements pour le clic sur le div
// monDiv.addEventListener("click", function() {
//     // Obtenez la valeur actuelle de l'input et convertissez-la en nombre
//     var inputValue = parseFloat(monInput.value);
//     // Effectuez l'opération 2000 + la valeur de l'input
//     var resultat = 1000 + inputValue + ': Livraison hors dakar';
//     // Mettez à jour la valeur de l'input avec le résultat de l'opération
//     monInput.value = resultat;
// });



// Sélectionnez tous les divs par leur classe
var divs = document.querySelectorAll(".livraisonDiv");

// Sélectionnez l'input par son ID
var monInput = document.getElementById("monInput");

// Ajoutez un gestionnaire d'événements pour chaque div
divs.forEach(function(div) {
    div.addEventListener("click", function() {
        // Effectuez l'opération en fonction de la classe du div cliqué
        var resultat;
        if (div.classList.contains("livraisonDK")) {
            resultat = 'subtotal + 1500: Livraison Dakar';
        } else if (div.classList.contains("livraisonHDK")) {
            resultat = 'subtotal + 2000: Livraison hors Dakar';
        } else if (div.classList.contains("livraisonG")) {
            resultat = 'subtotal: Livraison Dakar gratuite';
        }
        // Mettez à jour la valeur de l'input avec le résultat de l'opération
        monInput.value = resultat;
    });
});








  //modifier la quantité dans le panier
    function updateQuantity(qty)
    {
        $('#rowId').val($(qty).data('rowid'));
        $('#quantity').val($(qty).val());
        $('#updateCartQty').submit();
    }
//SUPPRIMER DES ARTICLES DANS LE PANIER
function removeItemFromCart(rowId)
    {
        $('#rowId_D').val(rowId);
        $('#deleteformCart').submit();
    }

//VIDER LE PANIER
function clearCart()
    {
        $('#clearCart').submit();
    }

    document.addEventListener('DOMContentLoaded', function() {
    let inputElement = document.getElementById("form3Examplea2");

    optionLivraisonDK = document.querySelector(".livraisonDK");
    optionLivraisonDK.onclick = function sommeTotal() {
    affichlvrDK = document.querySelector(".sommeTotalDK");
    affichlvrDK.classList.add("active");
    affichlvrHDK = document.querySelector(".sommeTotalHDK");
    affichlvrHDK.classList.remove("active");
    affichlvrG = document.querySelector(".sommeTotalG");
    affichlvrG.classList.remove("active");
    focuslvrDK = document.querySelector(".tbnlvrDK");
    focuslvrDK.classList.add("active");
    focuslvrHDK = document.querySelector(".tbnlvrHDK");
    focuslvrHDK.classList.remove("active");
    focuslvrG = document.querySelector(".tbnlvrG");
    focuslvrG.classList.remove("active");

    // Vérifier si la classe 'active' est présente sur l'élément affichlvrDK
    if (sommeTotal) {
        // Effectuer l'opération 1 + 1 sur la valeur actuelle de l'input
        let newValue = parseInt(inputElement.value) + 2000 + ':Livraison Dakar';

        // Mettre à jour la valeur de l'input avec le résultat de l'opération
        inputElement.value = newValue;
    }
   };
});

      optionLivraisonHDK = document.querySelector(".livraisonHDK");
      optionLivraisonHDK.onclick = function(){
      affichlvrHDK = document.querySelector(".sommeTotalHDK");
      affichlvrHDK.classList.add("active");
      affichlvrDK = document.querySelector(".sommeTotalDK");
      affichlvrDK.classList.remove("active");
      affichlvrG = document.querySelector(".sommeTotalG");
      affichlvrG.classList.remove("active");
      focuslvrHDK = document.querySelector(".tbnlvrHDK");
      focuslvrHDK.classList.add("active");
      focuslvrDK = document.querySelector(".tbnlvrDK");
      focuslvrDK.classList.remove("active");
      focuslvrG = document.querySelector(".tbnlvrG");
      focuslvrG.classList.remove("active");

      };

      optionLivraisonG = document.querySelector(".livraisonG");
      optionLivraisonG.onclick = function(){
      affichlvrG = document.querySelector(".sommeTotalG");
      affichlvrG.classList.add("active");
      affichlvrDK = document.querySelector(".sommeTotalDK");
      affichlvrDK.classList.remove("active");
      affichlvrHDK = document.querySelector(".sommeTotalHDK");
      affichlvrHDK.classList.remove("active");
      focuslvrG = document.querySelector(".tbnlvrG");
      focuslvrG.classList.add("active");
      focuslvrHDK = document.querySelector(".tbnlvrHDK");
      focuslvrHDK.classList.remove("active");
      focuslvrDK = document.querySelector(".tbnlvrDK");
      focuslvrDK.classList.remove("active");

      };

  </script>


@endsection
