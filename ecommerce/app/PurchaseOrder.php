<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //
    public function getUser() {
        return $this->belongsTo('App\User');
    }

    public function getProducts() {
        return $this->belongsToMany('App\Product', 'product_purchase_order', 'purchase_order_id', 'product_id');
    }
}
