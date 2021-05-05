<?php

namespace App\Http\Requests\Offers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Frequest extends FormRequest
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

                'name_ar'=>'required|max:100|unique:offers',
                'name_en'=>'required|max:100|unique:offers',
                'email' =>'required|unique:offers',
                'detales_ar' =>'required|unique:offers',
                'detales_en' =>'required|unique:offers',



        ];
    }
    public function messages()
    {
        return [
            'name_en.required' => 'please Input Name',
            'name_ar.required' => 'please Input Name',
                'name_ar.unique' => 'must be unique',
                'name_en.unique' => 'must be unique',
                'email.unique' => 'Email must be unique',

        ];
    }

}
