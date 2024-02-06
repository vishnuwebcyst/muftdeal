<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingItems extends Model
{
    use HasFactory;

   public function menu() {
    return $this->hasMany('App\Models\Menu', 'id' , 'product_id');
}
}
