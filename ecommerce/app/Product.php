<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function usersWhoHaveSeenIt() {
        return $this->belongsToMany('App\User', 'user_product', 'product_id', 'user_id');
    }

    public function purchaseOrders() {
        return $this->belongsToMany('App\PurchaseOrder', 'product_purchase_order', 'product_id', 'purchase_order_id')->withPivot('quantity');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
