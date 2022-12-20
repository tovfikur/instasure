<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DueBalanceCollectionStoreRequest extends FormRequest
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
            'dealer_id' => ['required'],
            'collection_date' => ['required'],
            'collected_amount' => ['required', 'numeric'],
            'document' => ['sometimes', 'nullable', 'image', 'mimes:jpg,bmp,png,jpeg'],
        ];
    }

    public function messages()
    {
        return [
            'dealer_id.required' => "Dealer required",
            'collection_date.required' => "Collection date required",
            'collected_amount.required' => "Collected amount required",
            'collected_amount.numeric' => "Collected amount must be numeric",
            'document.mimes' => "Image formats should be /png/jpeg/jpg",

        ];
    }
}
