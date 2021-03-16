<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class CheckoutStoreRequest extends FormRequest
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
            'name' => Rule::requiredIf(!Auth::check()).'|string|min:2|max:191',
            'lastname' => Rule::requiredIf(!Auth::check()).'|string|min:2|max:191',
            'email' => Rule::requiredIf(!Auth::check()).'|string|email|max:191',
            'phone' => 'required|string|min:5|max:15',
            'shipping' => 'required|'.Rule::in(["1", "2", "3"]),
            'address' => Rule::requiredIf($this->shipping=="3").'|string|min:2|max:191',
            'payment' => 'required|'.Rule::in(["1", "2", "3"]),
            'password' => Rule::requiredIf(!Auth::check()).'|string|min:8|confirmed'
        ];
    }
}
