<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            'logo' => 'required_without:id|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:100',
            'mobile' => 'required|max:100|unique:vendors,mobile,'.$this -> id,
            'email' => 'sometimes|nullable|email|unique:vendors,email,'.$this -> id,
            'category_id' => 'required|exists:main_categories,id',
            'address' => 'required|string|max:500',
            'password' => 'required_without:id',
        ];
    }

    public function messages()
    {
        return[
            'required' => 'هذا الحقل مطلوب',
            'max' => 'هذا الحقل يحتوي على حروف كثيرة',
            'category_id.exists' => 'القسم غير موجود',
            'email.email' => 'صيغة البريد الالكتروني غير صحيحة',
            'logo.required_without' => 'الصورة مطلوبة',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل',
            'mobile.unique' => 'رقم الهاتف مستخدم من قبل'
        ];
    }
}
