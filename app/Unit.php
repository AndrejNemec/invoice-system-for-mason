<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $fillable = ['name', 'pattern'];

    public function items() {
        return $this->hasMany('App\Item', 'catalog_id');
    }

}
