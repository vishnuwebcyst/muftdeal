<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu_items extends Model
{
    use HasFactory;
    public function itemType() {

        return $this->hasOne('App\Models\itemType', 'id' , 'menu_id');

    }



    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
