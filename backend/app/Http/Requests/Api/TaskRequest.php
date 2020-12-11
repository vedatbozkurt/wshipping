<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class TaskRequest extends FormRequest
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
          'sender_id' => 'required',
          'receiver_id' => 'required',
          'sender_address_id' => 'required',
          'receiver_address_id' => 'required',
          'price' => 'required',
          'description' => 'required',
        ];

    }
  }

