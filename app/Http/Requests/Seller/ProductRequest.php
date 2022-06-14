<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shop_id' => 'required',
            'title' => 'required|max:256|string',
            'desc' => 'required|string',
            'cost' => 'required',
            'subcategory_id' => 'required',
            'gender' => 'required|string',
            'color_id' => 'required'
        ];
    }
}
