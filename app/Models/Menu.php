<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function itemType() {
        return $this->hasMany('App\Models\food_type', 'id' , 'food_id');
    }

}
