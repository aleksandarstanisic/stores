<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return bauth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => [
                'required',
                // Address must be valid and belong to buyer
                Rule::exists('addresses', 'id')->where(function($query) {
                    $query->where('buyer_id', bauth()->user()->id);
                }),

            ]
        ];
    }
}
