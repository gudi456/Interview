<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierUpdateRequest extends FormRequest
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
        $supplierId = $this->route('id');
        return [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255|alpha_num',
            'email' => 'required|string|email|max:255|unique:users,email,' . $supplierId,
            'contact_number' => 'required|string|max:20',
            'postcode' => 'required|string|max:10',
            'state' => 'required|exists:states,id',
            'city' => 'required|exists:cities,id',
            'hobbies' => 'required|array|min:1',
            'hobbies.*' => 'string',
            'gender' => 'required|in:Male,Female',
            'files.*' => 'mimes:jpeg,png,pdf|max:2048'
        ];
    }
}
