<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $fillable = ['name', 'price', 'catalog_id', 'unit_id'];

    public function catalog() {
        return $this->belongsTo('App\Catalog', 'catalog_id');
    }

    public function unit() {
        return $this->belongsTo('App\Unit', 'unit_id');
    }

    public function projectItems() {
        return $this->hasMany('App\ProjectItem');
    }

}
