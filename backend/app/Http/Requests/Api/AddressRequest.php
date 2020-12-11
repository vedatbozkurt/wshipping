<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class AddressRequest extends FormRequest
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
          'user_id' => 'required',
          'city_id' => 'required',
          'district_id' => 'required',
          'name' => 'required',
          'description' => 'required',
        ];

    }
  }

