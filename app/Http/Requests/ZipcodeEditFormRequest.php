<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZipcodeEditFormRequest extends Request
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
            'city'=> 'required',
            'state'=> 'required',
            'state_name'=> 'required',
            'zipcode'=> 'required',
            'county'=> 'required',
            'country'=> 'required',
            'lat'=> 'required',
            'lon'=> 'required',
        ];
    }
}
