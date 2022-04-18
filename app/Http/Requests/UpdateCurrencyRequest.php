<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCurrencyRequest extends FormRequest
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
            'code' => 'required|unique:currencies,code,'.$this->currency,
            // 'title' => 'required',
            'decimal_places' => 'min:0',
            'value' => 'required',
            'status' => 'required|in:Enabled,Disabled',
        ];
    }
}
