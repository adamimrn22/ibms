<?php

namespace App\Http\Requests\SuperAdmin\User;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('Super Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|unique:users,username,except,id|min:5|max:15',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email,except,id|email',
            'position_id' => 'required',
            'unit_id' => 'required',
            'phone_number' => 'required'
        ];
    }
}
