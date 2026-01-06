<?php

namespace App\Http\Requests;

use App\UserRoleEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard(UserRoleEnum::ADMIN)->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
            'name' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:20'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer']
        ];
    }

    public function messages(){
        return [
            'image.image' => 'Please upload a valid image',
            'image.mimes' => 'Only :values extension types are allowed',
            'image.max' => 'File size should not exceed 2MB',

            'name.required' => 'Name is required',
            'name.string' => 'Please enter a valid name',
            'name.max' => 'Name cannot have more than :max characters',

            'description.required' => 'Description is required',
            'description.string' => 'Please enter a valid description',
            'description.max' => 'Description cannot have more than :max characters',

            'category.string' => 'Please enter a valid category',
            'category.max' => 'Category cannot have more than :max characters',

            'price.required' => 'Price is required',
            'price.string' => 'Please enter a valid price',
            'price.min' => 'Price cannot be invalid number',

            'stock.required' => 'Stock is required',
            'stock.integer' => 'Stock cannot be invalid number',
        ];
    }
}
