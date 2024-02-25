<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required','unique:products','max:100'],
            'price' => ['required','numeric','integer','min:0'],
            'category'=>['required','exists:categories,id'],
            'desc'=>['required'],
            'image'=>['required','mimes:jpg,png,bmp']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.unique'=>'Tên sản phẩm đã tồn tại',
            'name.max'=>'Tên sản phẩm không được quá 100 ký tự',
            'price.required'=>"Giá tiền không được bỏ trống",
            'price.numeric' => "Giá tiền phải là số",
            'price.integer'=>'Giá tiền phải là số nguyên',
            'price.min'=>'Giá tiền không được nhỏ hơn 0',
            'category.required'=>'Loại sản phẩm không được bỏ trống',
            'category.exists'=>'Loại sản phẩn không tồn tại',
            'desc.required'=>'Mô tả không được bỏ trống',
            'image.required'=>'Hình ảnh sản phẩm không được bỏ trống',
            'image.mimes'=>'Đuôi hình ảnh phải là jpg hoặc png và bmp'
        ];
    }
}
