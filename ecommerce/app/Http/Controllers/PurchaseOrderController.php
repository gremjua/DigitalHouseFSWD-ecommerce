<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        // dd($cart);
        if($cart->isEmpty()) {                 // if there is no shopping cart for this user, create one
            $po = new PurchaseOrder(['is_done' => false]);
            $user->purchaseOrders()->save($po);
            $po->products()->attach($product->id, ['quantity' => $req['quantity']]);
        }
        elseif($cart->first()->products->contains($product)) { // if the product is already in the cart
            $currentQuantity = $cart->first()->products()->where('product_id', $product->id)->get()->first()->pivot->quantity;
            $cart->first()->products()->updateExistingPivot($product->id,array('quantity' => $currentQuantity + $req['quantity']));
        }
        else {
            $cart->first()->products()->attach($product->id, ['quantity' => $req['quantity']]);
        }

        

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
