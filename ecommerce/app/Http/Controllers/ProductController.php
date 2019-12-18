<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function directory() {
        $products = Product::orderBy('name')
            ->paginate(9);
        return view('products', compact('products'));
    }

    public function show($id) {
        $product = Product::find($id);
        return view('product', compact('product'));
    }
}
