<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class CourierRequest extends FormRequest
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
          'email' => 'required|email|unique:couriers',
          'password'  => 'required|min:3',
          'vehicle'  => 'required',
          'plate'  => 'required',
          'color'  => 'required',
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
          'email' => 'required|email|unique:couriers,email,'.$this->route('courier')->id,
          'password'  => 'sometimes|required|min:3',
          'vehicle'  => 'required',
          'plate'  => 'required',
          'color'  => 'required',
          'status'  => 'required'
        ];
      }
      default: break;
    }

  }
}

