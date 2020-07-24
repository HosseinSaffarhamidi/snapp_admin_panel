<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class DriverRequest extends FormRequest
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
        $validate=[
            'name'=>'required',
            'mobile'=>'required|unique:drivers,mobile,'.$this->driver.',_id',
            'car_type'=>'required',
            'code_number_plates'=>'required',
            'city_code'=>'required',
            'number_plates'=>'required',
            'city_number'=>'required',
            'img'=>'image',

        ];
        if($this->getMethod()=='POST'){
           $validate['password']='required|min:6';
        }
        return $validate;

    }
    public function attributes()
    {
        return [
            'name'=>'نام راننده',
            'mobile'=>'شماره موبایل',
            'car_type'=>'نوع ماشین',
            'code_number_plates'=>'کد منطقه',
            'city_code'=>'کد پلاک',
            'number_plates'=>'حرف',
            'city_number'=>'کد شهر',
            'img'=>'تصویر راننده',
            'password'=>'کلمه عبور'
        ];
    }
}
