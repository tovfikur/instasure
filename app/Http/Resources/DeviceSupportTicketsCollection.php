<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DeviceSupportTicketsCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($item) {
                $device_info                    = json_decode($item->deviceInsurance->device_info);
                $serviceCenter                  = $item->serviceCenter;
                return [
                    'service_center_name'       => !empty($serviceCenter) ? $serviceCenter->service_center_name : 'Instasure',
                    'service_center_address'    => !empty($serviceCenter) ? $serviceCenter->address : 'Instasure Address.',
                    'device_name'               => ucwords($device_info->brand_name . ' ' . $device_info->model_name),
                    'brand_name'                => ucfirst($device_info->brand_name),
                    'model_name'                => ucfirst($device_info->model_name),
                    'claim_type'                => ucfirst($item->claim_type),
                    'claim_note'                => ucfirst($item->claim_note),
                    'claim_status'              => ucfirst($item->status),
                    'claim_date'                => date_format_custom($item->created_at, 'd M, Y'),

                ];
            })
        ];
    }


    /**
     * Get additional meta data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'success' => true,
            'code' => 200
        ];
    }
}
