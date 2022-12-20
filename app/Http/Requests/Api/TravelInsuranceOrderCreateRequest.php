<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TravelInsuranceOrderCreateRequest extends FormRequest
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
            'plan_category_id'      => ['required', 'min:1'],
            'plan_chart_id'         => ['required', 'min:1'],
            'full_name'             => ['required', 'max:50', 'min:5'],
            'age'                   => ['required', 'numeric'],
            'phone'                 => ['required', 'regex:/(01)[0-9]{9}/', 'size:11'],
            'email'                 => ['sometimes', 'email', 'nullable'],
            'passport_number'       => ['required'],
            'passport_expire_till'  => ['required', 'date', 'date_format:Y-m-d', 'after:return_date'],
            'dob'                   => ['required', 'date', 'date_format:Y-m-d', 'before:today'],
            'flight_date'           => ['required', 'date', 'date_format:Y-m-d', 'after_or_equal:tomorrow'],
            'return_date'           => ['required', 'date', 'date_format:Y-m-d', 'after:flight_date'],
            'total_days'            => ['required', 'numeric', 'min:1'],
            'flight_number'         => ['required'],
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
