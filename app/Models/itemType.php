<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class itemType extends Model
{
    use HasFactory;

    public function menu_items() {
        return $this->hasOne('App\Models\menu_items', 'item_type' , 'id');

    }
}
