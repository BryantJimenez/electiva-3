<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'image' => 'nullable|file|mimetypes:image/*',
            'name' => 'required|string|min:2|max:191|'.Rule::unique('products')->ignore($this->slug, 'slug'),
            'category_id' => 'required',
            'qty' => 'required|integer|min:0',
            'discount' => 'required|integer|min:0|max:100',
            'description' => 'required|string|min:2|max:65000',
            'price' => 'required|min:0'
        ];
    }
}
