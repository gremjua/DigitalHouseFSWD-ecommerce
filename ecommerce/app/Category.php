<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function products() {
        return $this->hasMany('App\Product');
    }

    public function children() {
        return $this->hasMany('Category','parent_id');
    }
    public function parent() {
        return $this->belongsTo('Category','parent_id');
    }
}
