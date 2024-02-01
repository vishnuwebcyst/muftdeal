<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $city = [
            [
               'city_name'=>'Amritsar',
            ],
            [
               'city_name'=>'Batala',
            ],
            [
               'city_name'=>'Chandigarh',
            ],
            [
               'city_name'=>'Faridkot',
            ],
            [
               'city_name'=>'Gurdaspur',
            ],
            [
               'city_name'=>'Abohar',
            ],

        ];

        foreach ($city as $key => $value) {
            City::create($value);
        }    }

}
