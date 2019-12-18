<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Comment;

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
        if(isset($user)){
            $user->seenProducts()->attach($product->id);
        }

        $comments = $product->comments;

        return view('productDetail', compact('product', 'comments', 'added'));
    }

    public function comment(Request $req) {
        $user = Auth::user();
        
        // $com = new App\Comment(['text' => $req->text,'user_id' => $user->id, 'product_id' => $req->productId]);
        // $user->comments()->save($com);

        $com = new Comment(['text' => $req->text,"user_id" => $user->id, 'product_id' => $req->productId]);
        $com->save();
        // Comment::save(['text' => $req->text, 'user_id' => $user->id, 'product_id' => $req->productId]);

        return redirect("/product/$req->productId");
    }
}
