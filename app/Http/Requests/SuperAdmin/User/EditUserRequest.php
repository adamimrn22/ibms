<?php

namespace App\Http\Requests\SuperAdmin\User;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('user.update') || $this->user()->hasRole('Super Admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('user');

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => "required|email|unique:users,email,$id,id",
            'position_id' => 'required',
            'unit_id' => 'required',
            'isActive' => 'required',
            'phone_number' => 'required'
        ];
    }
}
