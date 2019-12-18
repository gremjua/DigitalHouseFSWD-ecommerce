<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PurchaseOrder;
use App\Product;

class PurchaseOrderController extends Controller
{
    public function show() {
        $user = Auth::user();
        $cart = $user->purchaseOrders()->where('is_done', false)->get();
        return view('cart', compact('cart'));   //cart can be empty
    }

    public function add(Request $req) {
        $rules = [
                    'productId' => 'required|integer',
                    'quantity' => 'required|integer|min:1'
                ];
        $errors = [
                    'required' => 'El campo :attribute es requerido',
                    'min' => 'El campo :attribute debe ser al menos :min',
                    'integer' => 'El campo :attribute debe ser un entero'
                ];
        $this->validate($req, $rules, $errors);

        $user = Auth::user();
        $cart = $user->purchaseOrders()->where('is_done', false)->get();
        $product = Product::find($req['productId']);

        $cart->products()->attach($product->id);

        return redirect("/product/$product->id/added");
    }

    public function delete(Request $req) {
        $user = Auth::user();
        $product = Product::find($req->productId);
        $cart = $user->purchaseOrders()->where('is_done', false)->get();

        $cart->products()->detach($product->id);

        return redirect('/cart');
    }
}
