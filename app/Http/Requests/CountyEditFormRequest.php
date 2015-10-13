<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CountyEditFormRequest extends Request
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
            'state_id'=> 'required',
            'county'=> 'required',
            'label'=> 'required',
            'locale'=> 'required',
        ];
    }
}
