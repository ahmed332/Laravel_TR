<?php

namespace App\Http\Requests\Offers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class update extends FormRequest
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
    public function rules(Request $request)
    {
        return [

                'name_ar'=>'required|max:100',
                'name_en'=>'required|max:100',
                'email' =>'required',
                'detales_ar' =>'required',
                'detales_en' =>'required',



        ];
    }
    public function messages()
    {
        return [
            'name_en.required' => 'please Input Name',
            'name_ar.required' => 'please Input Name',
              

        ];
    }

}
