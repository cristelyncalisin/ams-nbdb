<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'employee_id' => [ 'required', 'unique:employees,employee_id' ],
            'first_name' => [ 'required' ],
            'middle_name' => [ 'max:255' ],
            'last_name' => [ 'required' ],
            'email' => [ 'required', 'email' ],
            'position' => [ 'max:255' ],
            'division' => [ 'required' ],
            'personnel_type' => [ 'required' ]
        ];
    }
}
