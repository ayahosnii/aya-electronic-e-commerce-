<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            'image' => 'required_without:id|mimes:jpg,jpeg,png,webp',
            'name' => 'required|string|max:100',
            'description' => 'required',
            'regular_price' => 'required|max:20',
            'SKU' => 'required|string|max:200',
            'category_id' => 'required|exists:main_categories,id',
            'stock_status' => 'required',
        ];

    }
}
