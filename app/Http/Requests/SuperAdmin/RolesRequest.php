<?php

namespace App\Http\Requests\SuperAdmin;

use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

use Spatie\Permission\Models\Role;

class RolesRequest extends FormRequest
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
           'name' => 'string|required|not_regex:/[0-9]+/',
           'permissions' => 'required|array'
        ];
    }
}
