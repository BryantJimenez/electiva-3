<?php

namespace App\Http\Requests;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductStoreRequest extends FormRequest
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

  protected function prepareForValidation()
  {
    $trashed=Product::where('slug', Str::slug($this->name))->withTrashed()->exists();
    $exist=Product::where('slug', Str::slug($this->name))->exists();
    ($trashed) ? $this->merge(['trashed' => true]) : $this->merge(['trashed' => false]);
    ($exist) ? $this->merge(['exist' => true]) : $this->merge(['exist' => false]);
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    if ($this->trashed && $this->exist===false) {
      $product=Product::where('slug', Str::slug($this->name))->withTrashed()->first();
      $product->restore();
    }
    return [
      'image' => 'nullable|file|mimetypes:image/*',
      'name' => 'required|string|min:2|max:191|unique:products,name',
      'category_id' => 'required',
      'qty' => 'required|integer|min:0',
      'discount' => 'required|integer|min:0|max:100',
      'description' => 'required|string|min:2|max:65000',
      'price' => 'required|min:0'
    ];
  }
}
