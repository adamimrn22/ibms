<?php

namespace App\Http\Requests\Admin\Inventory\UPSM;

use Illuminate\Foundation\Http\FormRequest;

class addClassroomRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin UPSM');;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'classname' => 'required',
            'classLocation' => 'required',
            'classChair' => 'required',
            'classFoldableChair' => 'required',
            'classTable' => 'required',
            'classWhiteboard' => 'required',
            'classDuster' => 'required',
        ];
    }
}
