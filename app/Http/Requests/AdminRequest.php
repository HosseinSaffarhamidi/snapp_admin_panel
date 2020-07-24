<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class AdminRequest extends FormRequest
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
        $user_id= Auth::user()->_id;
        $array=[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'username' => 'required|string|max:255|unique:admin,'.$user_id.',_id',
        ];
        if(!empty(trim($this->password)))
        {
            $array['password']='string|min:6|confirmed';
        }
        return $array;
    }
    public function attributes()
    {
        $array=[
            'name' => 'نام',
            'email' => 'ایمیل',
            'username' => 'نام کاربری',
            'password'=>'کلمه عبور'
            ];
        return $array;
    }
}
