<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                        => $this->id,
            'user_type'                 => $this->user_type,
            'passport_number'           => $this->passport_number,
            'name'                      => $this->name,
            'phone'                     => $this->phone,
            'email'                     => $this->email,
            'address'                   => $this->address,
            'dob'                       => $this->dob,
            'avatar_original_img'       => $this->avatar_original ? img_absolute_path_custom($this->avatar_original) : null,
            'nid'                       => $this->nid ? (is_array(json_decode($this->nid)) ? img_absolute_path_custom(json_decode($this->nid)) : img_absolute_path_custom($this->nid))  : null,
            'passport_img'              => $this->passport ? img_absolute_path_custom(json_decode($this->passport)) : null,
            'birth_certificate_img'     => $this->birth_certificate ? img_absolute_path_custom($this->birth_certificate) : null,
            'driving_licence_img'       => $this->driving_licence ? img_absolute_path_custom($this->driving_licence) : null,
            'passport_expire_date'      => $this->passport_expire_till,

        ];
    }
}
