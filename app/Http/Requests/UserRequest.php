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
            'firstName' => 'required|alpha',
            'lastName' => 'required|alpha',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:6',
            'phoneNumber' => 'required|numeric|min_digits:10|max_digits:10',
            'country' => 'required',
            'state' => 'required',
            'profilePicture' => 'required|mimes:jpeg,jpg,png'
        ];
    }
}
