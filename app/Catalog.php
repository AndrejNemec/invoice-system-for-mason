<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = ['name'];

    protected $with = ['items'];

    public function items() {
        return $this->hasMany('App\Item', 'catalog_id');
    }

}
