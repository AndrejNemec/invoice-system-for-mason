<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name'];

    protected $appends = ['totalPrice'];


    public function projectItems()
    {
        return $this->hasMany('App\ProjectItem', 'project_id');
    }


    public function getTotalPriceAttribute()
    {
        return $this->projectItems->sum('price');
    }

    public function getDateOfIssueAttribute($value) {
        return date('Y-m-d', strtotime($value));
    }

    public function getDueDateAttribute($value) {
        return date('Y-m-d', strtotime($value));
    }

    public function getGroupItemsAttribute()
    {
        $groups = array_group_by($this->projectItems->all(), function ($row) {
            return $row->item->catalog->name;
        });

        $full_price = 0.0;

        foreach ($groups as $group => $value) {
            $total_price = 0.0;
            foreach ($value as $item) {
                $total_price += $item->price;
            }

            $groups[$group]['total_price'] = $total_price;

            $full_price += $total_price;
        }

        $groups['full_price'] = $full_price;

        return $groups;
    }

    public function getGroupsAttribute()
    {
        $groups = array_group_by($this->projectItems->all(), function ($row) {
            return $row->item->catalog->name;
        });

        $full_price = 0.0;

        foreach ($groups as $group => $value) {
            $total_price = 0.0;
            foreach ($value as $item) {
                $total_price += $item->price;
            }
            unset($groups[$group]);
            $groups[$group]['total_price'] = $total_price;
            $full_price += $total_price;
        }

        $groups['full_price'] = $full_price;

        return $groups;

    }

}
