@extends('layouts.app')

<?php
// SDK de Mercado Pago
require '../vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken(env('MP_ACCESS_TOKEN',''));

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

if(!empty($cart->products->all())){
  foreach ($cart->products as $product){
    $item = new MercadoPago\Item();
    $item->title = $product->name;
    $item->quantity = $product->pivot->quantity;
    $item->unit_price = $product->price;
    $myItems[] = $item;
  }
  $preference->items = $myItems;
  $preference->save();
}


?>

@section('title')
    Cart
@endsection

@section('content')

<div id="snackbar">You removed an item from your cart!</div>

<div class="container">
<!-- Shopping cart table -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Sub Total</div>
                    </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($cart->products as $product)
                    <tr>
                        <th scope="row" class="border-0">
                            <div class="p-2">
                            <img src="/storage/products/{{$product->image}}" alt="" width="70" class="img-fluid rounded shadow-sm">
                            <div class="ml-3 d-inline-block align-middle">
                                <h5 class="mb-0"> <a href="/product/{{$product->id}}" class="text-dark d-inline-block align-middle">{{$product->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-block">Category: {{$product->category->name}}</span>
                            </div>
                            </div>
                        </th>
                        <td class="border-0 align-middle"><strong>{{$product->price}}</strong></td>
                        <?php $quantity = $product->purchaseOrders()->where('purchase_order_id', $cart->id)->get()->first()->pivot->quantity ?>
                        <td class="border-0 align-middle"><strong>{{$quantity}}</strong></td>
                        <?php $subTotals[] = $quantity*$product->price?>
                        <td class="border-0 align-middle"><strong>${{$quantity*$product->price}}</strong></td>
                        <td class="border-0 align-middle">
                            <form action="/cart" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="productId" value="{{$product->id}}">
                                <input type="hidden" name="cartId" value="{{$cart->id}}">
                                <button type="submit" class="border-0 bg-transparent text-dark btn btn-lg" onclick="showSnackBar()"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                  @empty
                  <tr>
                      <td class="border-0 align-middle">
                            No items in your cart.
                      </td>
                  </tr>
                  @endforelse
                
                  @if (isset($subTotals))
                    <tr>
                        <td></td>
                        <td></td>
                        <th scope="col" class="bg-light">
                            <div class="py-2 text-uppercase">TOTAL</div>
                        </th>
                        <th scope="col" class="bg-light">
                            <div class="py-2 text-uppercase">${{array_sum($subTotals)}}</div>
                        </th>
                    </tr>
                  @endif
                  
              </tbody>
            </table>
            @if (isset($subTotals))
                <div class="container text-center">
                    <button class="btn btn-lg btn-dark" type="submit" onclick="window.location.href='{{$preference->sandbox_init_point}}'">Check Out</button>
                    {{-- <button class="btn btn-lg btn-dark" type="submit" onclick="window.location.href='/checkout'">Check Out</button> --}}
                </div>
            @endif
          </div>
          <!-- End -->

        </div>

@endsection