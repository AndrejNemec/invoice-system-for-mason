<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{

    protected $fillable = ['project_id', 'item_id', 'count'];

    protected $appends = ['pattern', 'price'];

    public function project() {
        return $this->belongsTo('App\Project', 'project_id');
    }

    public function item() {
        return $this->belongsTo('App\Item', 'item_id');
    }

    public function getPatternAttribute() {
        return replaceUnitPattern($this->item->unit->pattern,
            array(
                'a' => $this->item->price."€",
                'b' => $this->count.$this->item->unit->name));

    }

    public function getPriceAttribute() {
        return math_eval($this->item->unit->pattern, ['a' => $this->item->price, 'b' => $this->count]);
    }



}
