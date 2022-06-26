<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            // 'image' => 'sometimes|image|max:2048',
            'email' => 'required|email|unique:users,email,'.$this->user,
            'contact_no' => 'required|max:255',
            // 'designation' => 'required|max:255',
            'password' => 'nullable|required_with:password_confirmation|string|confirmed',
            'role' => 'required|max:255',
        ];
    }
}