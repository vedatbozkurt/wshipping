<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;
use Illuminate\Support\Facades\Auth;

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
          'city' => 'required',
          'district' => 'required',
          'name' => 'required',
          'image' => 'required',
          'phone' => 'required',
          'email' => 'required|email|unique:couriers',
          'password'  => 'required|min:3',
          'vehicle'  => 'required',
          'plate'  => 'required',
          'color'  => 'required',
          // 'status'  => 'required'
        ];
      }
      case 'PATCH':
      case 'PUT':
      {
        $rules = [
          'city' => 'required',
          'district' => 'required',
          'name' => 'required',
          'image' => 'required',
          'phone' => 'required',
          'password'  => 'sometimes|required|min:3',
          'vehicle'  => 'required',
          'plate'  => 'required',
          'color'  => 'required',
          // 'status'  => 'required'
        ];

        if (isset(Auth::guard('courier')->user()->id)) { //if updated by branch
          $rules += ['email' => 'required|email|unique:couriers,email,'.Auth::guard('courier')->user()->id];
        }else{ //if updated by admin or branch
          $rules += ['email' => 'required|email|unique:couriers,email,'.$this->route('courier')->id,];
        }

        return $rules;
      }
      default: break;
    }

  }
}

