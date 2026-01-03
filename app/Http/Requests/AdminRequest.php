<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:100', 'unique:admins,email'],
            'pass1' => ['required', 'alpha_num', 'min:8', 'max:20'],
            'pass2' => ['required', 'same:pass1']
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Please enter a valid name',
            'name.max' => 'Name cannot have more than 30 characters',

            'email.required' => 'Email is required',
            'email.email' => 'Please enter a valid email address',
            'email.max' => 'Email cannot have more than 100 characters',
            'email.unique' => 'This email is already registerd with us.',

            'pass1.required' => 'Password is required',
            'pass1.alpha_num' => 'Password should contain alphanumeric characters',
            'pass1.min' => 'Password should have atleast 8 characters',
            'pass1.max' => 'Password cannot have more than 20 characters',

            'pass2.required' => 'Please enter the password',
            'pass2.same' => 'Passwords mismatch'
        ];
    }
}
