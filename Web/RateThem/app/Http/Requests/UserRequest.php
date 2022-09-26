<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'firstname' => 'required|string|max:75',
            'lastname' => 'required|string|max:50',
            'pseudo' => 'required|string|unique:users|max:50',
            'email' => 'sometimes:required|string||email|unique:users|max:255',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:255',
            'password' => ['sometimes:required', 'string', 'min:8', Password::defaults()],
        ];
    }
}
