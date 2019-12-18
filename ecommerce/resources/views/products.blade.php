@extends('layouts.app')

@section('title')
    Ecom Products
@endsection

@section('content')

<div class="container">
    <div class="row">

        @foreach ($products as $product)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="/product/{{$product->id}}"><img class="card-img-top" src="/storage/products/{{$product->image}}" alt=""></a>
                    <div class="card-body">
                    <h4 class="card-title">
                        <a href="/product/{{$product->id}}">{{$product->name}}</a>
                    </h4>
                    <h5>${{$product->price}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted">
                            @for($i = 0; $i < 5; $i++) 
                                @if($i < round($product->ranking))
                                    &#9733; 
                                @else
                                    &#9734;
                                @endif
                            @endfor</small>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
      <!-- /.row -->
</div>

@endsection