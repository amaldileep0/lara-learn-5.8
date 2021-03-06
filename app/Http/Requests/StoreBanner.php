<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBanner extends FormRequest
{  

    protected $casts = [
        'active' => 'boolean',
    ];
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
           'title' => 'required|max:150',
           'file' => 'required|file|max:5000|mimes:jpeg,png,jpg',
           'order' => 'required|int',
           'active' => 'boolean'
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'title.required' => ':attribute must not be blank',
            'order.int' => ':attribute must be an integer',
            'order.required' => ':attribute must not be blank',
            'file.required' => ':attribute cannot be blank'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
    */
    public function attributes()
    {
        return [
            'title' => 'Title',
            'file' => 'Image',
            'order' => 'Order',
            'active' => 'Active'
        ];
    }

}
