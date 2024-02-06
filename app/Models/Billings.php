<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billings extends Model
{
    use HasFactory;
    public function billingItems()
{
    return $this->hasMany(BillingItems::class, 'billing_id');
}
    public function menu()
{
    return $this->belongsTo(Menu::class, 'product_id');
}
}
