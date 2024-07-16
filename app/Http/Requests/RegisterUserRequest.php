<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255|alpha_num',
            'email' => 'required|string|email|max:255|unique:users',
            'contact_number' => 'required|string|max:20',
            'postcode' => 'required|string|max:10',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'password' => 'required|string|min:8|confirmed',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'string',
            'roles' => 'required|array|min:1',
            'roles.*' => 'exists:roles,id',
            'gender' => 'required|in:Male,Female',
            'files.*' => 'mimes:jpeg,png,pdf|max:2048' // Example file validation (adjust as needed)
        ];
    }

    public function messages()
    {
        return [
            'lastname.alpha_num' => 'The last name may only contain letters and numbers.',
        ];
    }
}
