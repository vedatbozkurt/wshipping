<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class UserRequest extends FormRequest
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

    switch ($this->method()) {
      case 'POST':
      {
        return [
          'name' => 'required',
          'image' => 'required',
          'phone' => 'required',
          'email' => 'required|email|unique:users',
          'password'  => 'required|min:3',
          'status'  => 'required'
        ];
      }
      case 'PATCH':
      case 'PUT':
      {
        return [
          'name' => 'required',
          'image' => 'required',
          'phone' => 'required',
          'email' => 'required|email|unique:users,email,'.$this->route('user')->id,
          'password'  => 'sometimes|required|min:3',
          'status'  => 'required'
        ];
      }
      default: break;
    }

  }
}

