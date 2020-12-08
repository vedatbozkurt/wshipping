<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;
class AdminRequest  extends FormRequest
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
    /*return [
         'name' => 'required',
         'email' => 'required|email|unique:admins',
         'password'  => 'required|min:3',
     ];*/
     $rules = [
       'name' => 'required',
       'email' => 'required|email|unique:admins',
    ];

    if ($this->getMethod() == 'POST') {
        $rules += ['password' => 'required|min:3'];
    }
    return $rules;

    }

    public function messages()
    {
       return [
               'required' => 'Lütfen geçerli bir :attribute girin', //genel
               'name.required' => 'Adiniz gerekli', //name e ait mesajı değiştir
               'email.email' => 'Geçerli bir mail adresi girin',
           ];
       }
    }
