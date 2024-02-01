<?php

namespace App\Models;
use App\Models\background;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model implements Authenticatable
{
    use HasFactory;
    use AuthenticableTrait;
    protected $guard = 'restaurant';
    protected $guarded =[];

    // protected $fillable = [
    //     'restaurant_name',
    //     'city_name',
    //     'image',
    //     'phone',
    //     'password',
    //     'location',
    //     'background_id',
    //     'url',
    //     'show_pass',
    //     'menu_number',
    // ];
    protected $hidden = [
        'password',
    ];

    public function background()
    {
        return $this->belongsTo(background::class);
    }
     public function ratings()
    {
        return $this->hasMany(Rating::class, 'restaurant_id');
    }
}
