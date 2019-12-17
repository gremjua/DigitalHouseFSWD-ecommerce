<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function getUser() {
        return $this->belongsTo('App\User');
    }

    public function getProduct() {
        return $this->belongsTo('App\Product');
    }
}
