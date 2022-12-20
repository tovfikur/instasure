<?php

namespace App\Http\Resources;

use App\Model\DeliveryMan;
use App\Model\Experience;
use App\Model\Patients;
use App\Model\SecmoDr;
use App\Model\SpecialistDr;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChildDealerInfoCollections extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($data) {
                return [
                    'id' => $data->id,
                    'com_org_inst_name' => (string) $data->com_org_inst_name
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
