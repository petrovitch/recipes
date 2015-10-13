<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GltrnEditFormRequest extends Request
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
            'acct' => 'required|min:8|max:8',
            'description' => 'required|min:3',
            'crj' => 'required',
            'date' => 'required',
            'document' => 'required',
            'amount' => 'required',
        ];
    }
}
