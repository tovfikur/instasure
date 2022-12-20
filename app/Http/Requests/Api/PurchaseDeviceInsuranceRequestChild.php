<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PurchaseDeviceInsuranceRequestChild extends FormRequest
{
    use ResponseTrait;
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
            "package_id" => ['required'],
            "email" => ['sometimes', 'nullable', 'email'],
            "customer_id_type" => ['required', 'in:nid,passport'],
            "customer_id_number" => ['required'],
            "customer_id" => ['required'],
            "brand_id" => ['required'],
            "device_model_id" => ['required'],
            "imei_1" => ['required', 'min:15', 'max:25'],
            "imei_2" => ['sometimes', 'nullable', 'min:15', 'max:25'],
            "package_id" => ['required'],

        ];
    }


    /**
     * Throw validation error response
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return Illuminate\Http\Response json
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'       => false,
            'code'          => $this->get_error_code(422),
            'message'       => $this->get_error_message('Validation Error'),
            'data'          => $this->getMessages($validator)
        ]));
    }

    /**
     * Throw validation error response
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return Array
     */
    private function getMessages(Validator $validator)
    {
        $errors = ($validator->errors()->toArray());
        return call_user_func_array('array_merge', $errors);
    }
}
