<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdaterestaurantRequest extends FormRequest
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
            'image' => 'image|max:2000',
            'city_name' => 'required',
            'restaurant_name' => 'required',
            'restaurant_type' => 'required',
            'phone' => 'required',
            'location' => 'required|max:190',
            'url' => 'required',
            'open_time' => 'required',
            'close_time' => 'required',
         ];
    }
}
