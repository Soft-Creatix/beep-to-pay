<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLanguageRequest extends FormRequest
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
            'code' => 'required|unique:languages',
            // 'name' => 'required',
            'direction' => 'required|in:Left,Right',
            'type' => 'required|in:Primary,Secondary',
            'status' => 'required|in:Enabled,Disabled',
        ];
    }
}
