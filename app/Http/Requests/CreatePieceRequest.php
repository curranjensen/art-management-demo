<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePieceRequest extends FormRequest
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
            'number' => 'required|numeric|unique:pieces,number',
            'year' => 'nullable|numeric|date_format:Y',
            'month' => 'nullable|numeric|min:1|max:12',
            'media_id' => 'nullable|integer'
        ];
    }
}
