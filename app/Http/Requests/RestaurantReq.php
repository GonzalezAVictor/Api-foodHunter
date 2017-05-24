<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantReq extends FormRequest
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
            'name' => 'string',
            'openAt' => 'string',
            'closeAt' => 'string',
            'ubication' => 'string',
            'slogan' => 'string',
            'description' => 'string',
            'email' => 'email',
            'password' => 'string'
        ];
    }
}
