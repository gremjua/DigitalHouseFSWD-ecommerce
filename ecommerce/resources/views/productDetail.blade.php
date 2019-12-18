@extends('layouts.app')

@section('title')
    {{$product->name}}
@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-lg-3 position-sticky">
                <h1 class="my-4">{{$product->name}}</h1>
                <form action="/cart/add" method="post">
                    @csrf
                    <input type="hidden" name="productId" value="{{$product->id}}">
                    @if($product->stock >=1)
                        <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="showSnackBar()">Add to Cart</button>
                        {{-- <a href="#" class="list-group-item active">Add To Cart</a> --}}
                        <input name="quantity" type="number" class="text-center form-control" value="1" min="1" max="{{$product->stock}}">
                    @else
                        Out Of Stock
                    @endif
                </form>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">

                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="/storage/products/{{$product->image}}" alt="">
                    <div class="card-body">
                    <h3 class="card-title">${{$product->price}}</h3>
                    <p class="card-text">{{$product->description}}</p>
                    <span class="text-warning">
                        @for($i = 0; $i < 5; $i++) 
                        @if($i < round($product->ranking))
                            &#9733; 
                        @else
                            &#9734;
                        @endif
                    @endfor</span>
                    {{$product->ranking}} stars
                    </div>
                </div>
                <!-- /.card -->

                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        Product Comments
                    </div>
                    <div class="card-body">
                        @forelse ($comments as $comment)
                            <p>{{$comment->text}}</p>
                            <small class="text-muted">Posted by {{$comment->user->name}} on {{$comment->created_at}}</small>
                            <hr>
                        @empty
                            {{-- <p>There are no comments for this product</p>  --}}
                         @endforelse
                        {{-- <hr> --}}
                        <a href="#" class="btn btn-success">Leave a Comment</a>
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

        <div id="snackbar">You added an item to your cart!</div>

    </div>
      <!-- /.container -->

@endsection