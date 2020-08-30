<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'image'=>'required|mimes:png,jpg,jpeg',
            'name' => 'required|max:100',
            'description' => 'required',
            'price' => 'required|numeric',
            'category'=>'required',

        ];
    }
    public function messages()
    {

        return [
            'image.required' => 'image required',
            'name.required' => ' name required',
            'price.numeric' => 'Bid price must be numbers',
            'price.required' => 'price field required',
            'description.required' => 'description field required ',
            'image.mimes' => 'Invalid image',
            'category.required'=>'category is required',
        ];
    }
}
