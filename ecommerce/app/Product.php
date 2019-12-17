<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function getUsersWhoHaveSeenIt() {
        return $this->belongsToMany('App\User', 'user_product', 'product_id', 'user_id');
    }

    public function getPurchaseOrders() {
        return $this->belongsToMany('App\PurchaseOrder', 'product_purchase_order', 'product_id', 'purchase_order_id');
    }

    public function getCategory() {
        return $this->belongsTo('App\Category');
    }

    public function getComments() {
        return $this->hasMany('App\Comment');
    }
}
