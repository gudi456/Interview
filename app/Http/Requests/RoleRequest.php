<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255|unique:roles',
                    // Add more validation rules as needed
                ];
            case 'PUT':
            case 'PATCH':
                $roleId = $this->route('id'); // Get role ID from route
                return [
                    'name' => 'required|string|max:255|unique:roles,name,' . $roleId,
                    // Add more validation rules as needed
                ];
            default:
                return [];
        }
    }
}
