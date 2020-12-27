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
        $rules = [
           // 'city' => 'required',
          // 'district' => 'required',
          'name' => 'required',
          'phone' => 'required',
          'password'  => 'sometimes|required|min:3',
          // 'status'  => 'required'
        ];
          //çlışması için api ile id göndermen gerekiyor
          $rules += ['email' => 'required|email|unique:branches,email,'.\Request::instance()->id];

        return $rules;
      }
      default: break;
    }

  }
}

