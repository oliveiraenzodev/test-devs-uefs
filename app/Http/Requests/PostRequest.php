<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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

                'title' => 'required',
                'description' => 'required|min:12',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Title required',
            'description.required' => 'Description required',
            'description.min' => 'This field must have at least :min characters'
        ];
    }
}
