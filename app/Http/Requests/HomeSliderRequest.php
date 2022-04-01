<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HomeSliderRequest extends FormRequest
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
    'title', 'subtitle', 'price', 'link', 'image', 'active'
     */
    public function rules()
    {
        return [
            'image' => 'required_without:id|mimes:jpg,jpeg,png,webp',
            'title' => 'required|string|max:100',
            'subtitle' => 'required',
            'price' => 'required|max:20',
            'link' => 'required|string|max:200',
            'active' => 'required',
        ];
    }
}
