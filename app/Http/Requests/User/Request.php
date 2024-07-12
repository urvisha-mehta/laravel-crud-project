<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class Request extends FormRequest
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
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            'email' => 'required|email|unique:users,email,' . $this->user,
            'phone_number' => 'required|numeric|min_digits:10|max_digits:10',
            'country_id' => 'required',
            'state_id' => 'required',
        ];
    }
}
