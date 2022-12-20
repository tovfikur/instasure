<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerOtpVerificationRequest extends FormRequest
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
            'phone'         => ['required', 'regex:/(01)[0-9]{9}/', 'max:11'],
            'code'          => ['required', 'size:4'],
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
            'code'          => $this->get_error_code(),
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
