<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PartsUpdateRequest extends FormRequest
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
            'parent_dealer_id'          => ['required'],
            'parts_name'                => ['required'],
            'parts_price'               => ['required'],
            'status'                    => ['required']
        ];
    }

    public function messages()
    {
        return [
            'parent_dealer_id.required' => "Parent dealer required",
            'parts_name.required'       => "Parts name required",
            'parts_price.required'      => "Parts price required",
            'status.required'           => "Status required",
        ];
    }
}
