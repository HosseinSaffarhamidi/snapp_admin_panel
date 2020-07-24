<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
            'name'=>'required',
            'radius'=>'required|numeric',
            'fixed_price'=>'required|numeric',
            'price'=>'required|numeric'
        ];
    }
    public function attributes()
    {
        return [
            'name'=>'نام منطقه',
            'radius'=>'شعاع',
            'fixed_price'=>'هزینه ثابت',
            'price'=>'هزینه هر کیلومتر'
        ];
    }
}
