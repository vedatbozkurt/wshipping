<?php
/*
 * @Author: @vedatbozkurt
 * @Email: info@wedat.org
 * @Date: 2020-12-26 19:36:27
 * @LastEditors: @vedatbozkurt
 * @LastEditTime: 2020-12-26 19:36:27
 */

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class SettingRequest extends FormRequest
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
          'address' => 'required',
          'phone' => 'required',
          'company_name' => 'required',
          'description' => 'required',
          'keywords' => 'required',
          'logo' => 'required',
          'email' => 'required',
        ];
    }
}
