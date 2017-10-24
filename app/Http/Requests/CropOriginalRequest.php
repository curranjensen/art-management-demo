<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CropOriginalRequest extends FormRequest
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
            'width' => 'required|integer|min:1',
            'height' => 'required|integer|min:1',
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'width.required' => 'Please select an area to crop',
            'height.required' => 'Please select an area to crop',
            'x.required' => 'Please select an area to crop',
            'y.required' => 'Please select an area to crop',
        ];
    }
}
