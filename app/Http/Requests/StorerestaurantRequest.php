<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorerestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //

                'city_name' => 'required',
                'restaurant_name' => 'required',
                'phone' => 'required|unique:restaurants,phone',
                'location' => 'required',
                'url' => 'required',
                'password' => 'required',
                'image' => 'required|image',
                'restaurant_type' => 'required',
                'open_time' => 'required',
                'close_time' => 'required',

        ];
    }
}
