
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
                     <p>{{$product->subtotal()}}</p>
                      </div>
                      <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                        <a href="#!" class="text-muted"><i class="fas fa-times"></i></a>
                      </div>
                    </div>
                    @endforeach
                     <hr class="my-4">
                    <a href="/" class="btn btn-primary">Continuez le Shopping</a>
                     @else
                    <div clasS="row">
                        <div class="col-md-12 text-center">
                        <h3>Votre panier est vide</h3>
                        <a href="/" class="btn btn-primary">Shopping maintenant</a>
                        </div>
                    </div>
                    @endif
                  </div>
                </div>
                <div class="col-lg-4 bg-grey">
                <form class="" action="#" method="POST">
                @csrf
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-4">
                    <h6 class="text-uppercase"><span>{{ Cart::instance('cart.index')->content()->count() }}</span>  article @if (Cart::instance('cart.index')->content()->count() > 1) <span style="margin-left:-3px">s</span> @endif</h6>
                      <h5>{{Cart::instance('cart.index')->subtotal()}}</h5>
                    </div>
                    <h5 class="text-uppercase mb-3">Livraison</h5>
                    <div class="mb-4 pb-2">

                      <select class="select" name="livraison">



                      </select>

                    </div>
                    <h5 class="text-uppercase mb-3">Give code</h5>
                    <div class="mb-5">
                      <div class="form-outline">
                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                        <label class="form-label" for="form3Examplea2">Enter your code</label>
                      </div>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between mb-5">
                      <h5 class="text-uppercase">Total price</h5>
                        <h5>{{Cart::instance('cart.index')->subtotal()}}</h5>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg"
                      data-mdb-ripple-color="dark">Register</button>
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
  <form id="updateCartQty" action="{{route('cart.update')}}" method="POST">
    @csrf
    @method('put')
    <input type="hidden" id="rowId" name="rowId"/>
    <input type="hidden" id="quantity" name="quantity"/>
  </form>
  <script>
    function updateQuantity(qty)
    {
        $('#rowId').val($(qty).data('rowid'));
        $('#quantity').val($(qty).val());
        $('#updateCartQty').submit();
    }
  </script>
@endsection
