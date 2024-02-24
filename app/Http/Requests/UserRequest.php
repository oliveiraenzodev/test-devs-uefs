<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'password' => 'required|min:5'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name required',
            'email.required' => 'Email required',
            'email.email' => 'Email not valid',
            'username.required' => 'Username required',
            'password.required' => 'Password required',
            'password.min' => 'This field must have at least :min characters'
        ];
    }
}
