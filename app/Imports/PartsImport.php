<?php

namespace App\Imports;

use App\Model\Part;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)

    {
        return new Part([
            'brand_id'          => $row['brand_id'],
            'model_id'          => $row['model_id'],
            'user_id'           => $row['user_id'],
            'parent_dealer_id'  => $row['parent_dealer_id'],
            'parts_name'        => $row['parts_name'],
            'parts_price'       => $row['parts_price'],
            'status'            => $row['status'],
            'is_used'           => $row['is_used'],
            'note'              => $row['note'],
        ]);
    }
}
