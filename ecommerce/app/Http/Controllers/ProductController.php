<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;

class ProductController extends Controller
{
    public function directory() {
        $products = Product::orderBy('name')
            ->paginate(9);
        return view('products', compact('products'));
    }

    public function show($id, $added = null) {  //use $added to show a toast that product was just added
        $product = Product::find($id);

        $user = Auth::user();
        $user->seenProducts()->attach($product->id);

        $comments = $product->comments;

        return view('productDetail', compact('product', 'comments', 'added'));
    }
}
