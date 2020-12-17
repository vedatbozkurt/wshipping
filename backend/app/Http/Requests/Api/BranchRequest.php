<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;
use Illuminate\Support\Facades\Auth;

class BranchRequest extends FormRequest
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
          'phone' => 'required',
          'email' => 'required|email|unique:branches',
          'password'  => 'required|min:3',
          'status'  => 'required'
        ];
      }
      case 'PATCH':
      case 'PUT':
      {
        return [
          'city' => 'required',
          'district' => 'required',
          'name' => 'required',
          'phone' => 'required',
          'email' => 'required|email|unique:branches,email,'.$this->route('branch')->id,
          'password'  => 'sometimes|required|min:3',
          'status'  => 'required'
        ];
      }
      default: break;
    }

  }
}

