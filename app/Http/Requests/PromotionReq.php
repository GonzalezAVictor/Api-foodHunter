<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionReq extends FormRequest
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
            'details' => 'string',
            'startAt' => 'string',
            'endAt' => 'string',
            'promotion_type' => 'string',
            'amount_available' => 'integer',
            'restaurant_id' => 'integer'
        ];
    }
}
