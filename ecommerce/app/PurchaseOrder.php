<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    //
    protected $fillable = ['is_done'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function products() {
        return $this->belongsToMany('App\Product', 'product_purchase_order', 'purchase_order_id', 'product_id')->withPivot('quantity');
    }
}
