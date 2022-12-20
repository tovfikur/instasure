<?php

namespace App\Http\Requests\Api;

use App\Http\Traits\ResponseTrait;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MobileDiagnosisReportStoreRequest extends FormRequest
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
            "brand_name"                    => ['required', 'min:2', 'max:100'],
            "brand_model_name"              => ['required', 'min:2', 'max:100'],
            "device_serial_number"          => ['required', 'min:5', 'max:25'],
            "device_price"                  => ['required', 'numeric', 'min:1'],
            "motherboard_status"            => ['required', 'in:0,1'],
            "battery_health_status"         => ['required', 'in:0,1'],
            "front_camera_status"           => ['required', 'in:0,1'],
            "back_camera_status"            => ['required', 'in:0,1'],
            "microphone_status"             => ['required', 'in:0,1'],
            "ram_status"                    => ['required', 'in:0,1'],
            "rom_status"                    => ['required', 'in:0,1'],
            "display_screen_status"         => ['required', 'in:0,1'],
            "device_images"                 => ['required', 'array', 'max:3'],
            "device_images.*"               => ['file', 'mimes:jpg,jpeg,png,gif,bmp', 'max:4096'],
            "imei_image"                    => ['required', 'mimes:jpg,jpeg,png,gif,bmp', 'max:4096'],
            "invoice_image"                 => ['sometimes', 'mimes:jpg,jpeg,png,gif,bmp', 'max:4096'],
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
